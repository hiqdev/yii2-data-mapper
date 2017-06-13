<?php

namespace hiapi\query;

use hiapi\validators\AttributeValidationException;
use hiapi\validators\FieldValidator;
use hiapi\validators\AttributeValidatorFactory;
use yii\base\InvalidParamException;
use yii\db\QueryTrait;

class Specification
{
    use QueryTrait;

    public $requestedRelations = [];

    /**
     * @var AttributeValidatorFactory
     */
    private $fieldValidatorFactory;

    function __construct(AttributeValidatorFactory $fieldValidatorFactory)
    {
        $this->fieldValidatorFactory = $fieldValidatorFactory;
    }

    public function requestRelation($name)
    {
        $this->requestedRelations[$name] = true; // todo: specification for relation
    }

    /**
     * @param Query $query
     * @return Query
     */
    public function applyTo($query)
    {
        if ($this->where) {
            $this->applyWhereTo($query);
        }

        if ($this->limit) {
            $query->limit($this->limit);
        }

        return $query;
    }

    /**
     * @param Query $query
     * @throws AttributeValidationException
     */
    public function applyWhereTo($query)
    {
        $conditions = [];

        foreach ($this->where as $key => $condition) {
            foreach ($query->getFields() as $field) {
                if (is_array($condition)) {
                    throw new InvalidParamException('Condition ' . json_encode($condition) . ' is not supported yet.');
                }

                if ($field->nameEquals($key)) {
                    $validator = $this->fieldValidatorFactory->createFor($field, 'eq');
                    $value = $validator->normalize($condition);
                    $validator->validate($value);

                    $conditions[$field->getName()] = $value;
                }
            }
        }

        $query->andWhere($conditions);
    }
}
