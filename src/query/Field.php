<?php
/**
 * Data Mapper for Yii2
 *
 * @link      https://github.com/hiqdev/yii2-data-mapper
 * @package   yii2-data-mapper
 * @license   BSD-3-Clause
 * @copyright Copyright (c) 2017, HiQDev (http://hiqdev.com/)
 */

namespace hiqdev\yii\DataMapper\query;

use hiqdev\yii\DataMapper\query\attributes\AbstractAttribute;
use hiqdev\yii\DataMapper\validators\AttributeValidationException;
use yii\base\InvalidParamException;

class Field implements FieldInterface
{
    /**
     * @var string
     */
    protected $name;

    /**
     * @var string
     */
    protected $sql;

    /**
     * @var AbstractAttribute
     */
    protected $attribute;

    public function __construct($name, $sql, AbstractAttribute $attribute)
    {
        $this->name = $name;
        $this->sql = $sql;
        $this->attribute = $attribute;
    }

    public function canBeSelected()
    {
        return true;
    }

    public function isApplicable($key)
    {
        [, $attribute] = $this->parseFilterKey($key);

        return $attribute === $this->name;
    }

    /**
     * @param string $key the search key for operator and attribute name extraction
     * @return array of two items: the comparison operator and the attribute name
     */
    private function parseFilterKey($key)
    {
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
        if ($matches[3] && in_array($matches[3], $this->attribute->getSupportedOperators(), true)) {
            $operator = $matches[3];
            $key = $matches[1];
        }

        return [$operator, $key];
    }

    /**
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @return string
     */
    public function getSql()
    {
        return $this->sql;
    }

    /**
     * @return AbstractAttribute
     */
    public function getAttribute()
    {
        return $this->attribute;
    }

    /**
     * @param string $operator
     * @param mixed $value
     * @return mixed normalized $value
     * @throws AttributeValidationException when value is not valid
     */
    protected function ensureConditionValueIsValid($operator, $value)
    {
        $validator = $this->getAttribute()->getValidatorFor($operator);

        $value = $validator->normalize($value);
        $validator->ensureIsValid($value);

        return $value;
    }

    /**
     * // TODO: create ConditionBuilder?
     * @param $key
     * @param $value
     * @return array
     * @throws AttributeValidationException when value is not valid
     */
    public function buildCondition($key, $value)
    {
        [$operator, $attribute] = $this->parseFilterKey($key);

        if (is_array($value)) {
            return [$this->getSql() => $this->ensureConditionValueIsValid('in', $value)];
        }

        $operatorMap = [
            'eq' => '=',
            'ne' => '!=',
        ];

        return [$operatorMap[$operator] ?? $operator, $this->getSql(), $this->ensureConditionValueIsValid($operator, $value)];
    }
}
