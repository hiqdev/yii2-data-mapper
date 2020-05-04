<?php

namespace hiqdev\yii\DataMapper\query\Builder;

use hiqdev\yii\DataMapper\query\AttributedFieldInterface;
use hiqdev\yii\DataMapper\query\attributes\AttributeInterface;
use hiqdev\yii\DataMapper\query\attributes\validators\AttributeValidationException;
use hiqdev\yii\DataMapper\query\attributes\validators\AttributeValidator;
use hiqdev\yii\DataMapper\query\attributes\validators\Factory\AttributeValidatorFactoryInterface;
use hiqdev\yii\DataMapper\query\FieldConditionBuilderInterface;
use hiqdev\yii\DataMapper\query\FieldInterface;
use hiqdev\yii\DataMapper\query\SQLFieldInterface;

final class QueryConditionBuilder implements QueryConditionBuilderInterface
{
    /**
     * @var AttributeValidatorFactoryInterface
     */
    private AttributeValidatorFactoryInterface $attributeValidatorFactory;

    public function __construct(AttributeValidatorFactoryInterface $attributeValidatorFactory)
    {
        $this->attributeValidatorFactory = $attributeValidatorFactory;
    }

    public function build(FieldInterface $field, string $key, $value)
    {
        [$operator, $attribute] = $this->parseFieldFilterKey($field, $key);

        if ($field instanceof FieldConditionBuilderInterface) {
            return $field->buildCondition($operator, $attribute, $value);
        }

        if ($field instanceof SQLFieldInterface) {
            if (is_iterable($value)) {
                return [$field->getSql() => $this->ensureConditionValueIsValid($field, 'in', $value)];
            }

            $operatorMap = [
                'eq' => '=',
                'ne' => '!=',
            ];

            return [
                $operatorMap[$operator] ?? $operator,
                $field->getSql(),
                $this->ensureConditionValueIsValid($field, $operator, $value)
            ];
        }

        throw new \BadMethodCallException(sprintf('The passed field %s can not be built', $field->getName()));
    }

    public function canApply(FieldInterface $field, string $key): bool
    {
        [, $attribute] = $this->parseFieldFilterKey($field, $key);

        return $attribute === $field->getName();
    }

    /**
     * @param FieldInterface $field
     * @param string $operator
     * @param mixed $value
     * @return mixed normalized $value
     * @throws AttributeValidationException
     */
    private function ensureConditionValueIsValid(FieldInterface $field, string $operator, $value)
    {
        if (!$field instanceof AttributedFieldInterface) {
            return $value;
        }

        $validator = $this->getAttributeOperatorValidator($field->getAttribute(), $operator);
        $value = $validator->normalize($value);
        $validator->ensureIsValid($value);

        return $value;
    }

    /**
     * @param FieldInterface $field
     * @param string $key the search key for operator and attribute name extraction
     * @return array an array of two items: the comparison operator and the attribute name
     * @psalm-return array{0: string, 1: string} an array of two items: the comparison operator and the attribute name
     */
    private function parseFieldFilterKey(FieldInterface $field, string $key)
    {
        if (!$field instanceof AttributedFieldInterface
            || $field->getName() === $key
        ) {
            return ['eq', $key];
        }

        /*
         * Extracts underscore suffix from the key.
         *
         * Examples:
         * client_id -> 0 - client_id, 1 - client, 2 - _id, 3 - id
         * server_owner_like -> 0 - server_owner_like, 1 - server_owner, 2 - _like, 3 - like
         */
        preg_match('/^(.*?)(_((?:.(?!_))+))?$/', $key, $matches);

        $operator = 'eq';

        // If the suffix is in the list of acceptable suffix filer conditions
        if (isset($matches[3]) && in_array($matches[3], $field->getAttribute()->getSupportedOperators(), true)) {
            $operator = $matches[3];
            $key = $matches[1];
        }

        return [$operator, $key];
    }

    private function getAttributeOperatorValidator(AttributeInterface $attribute, string $operator): AttributeValidator
    {
        $rule = $attribute->getRuleForOperator($operator);

        return $this->attributeValidatorFactory->createByDefinition($rule);
    }
}
