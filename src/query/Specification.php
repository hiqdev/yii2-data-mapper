<?php

namespace hiapi\query;

use hiapi\validators\FieldValidationException;
use hiapi\validators\FieldValidator;
use hiapi\validators\FieldValidatorFactory;
use yii\base\InvalidParamException;
use yii\db\QueryTrait;

class Specification
{
    use QueryTrait;

    public $requestedRelations = [];

    /**
     * @var FieldValidatorFactory
     */
    private $fieldValidatorFactory;

    function __construct(FieldValidatorFactory $fieldValidatorFactory)
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
     * @throws FieldValidationException
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
                    if (!$this->fieldValidatorFactory->createFor($field, 'eq')->validate($condition)) {
                        throw new FieldValidationException('Value ' . $condition . ' is not valid');
                    }

                    $conditions[$field->getSql()] = $condition;
                }
            }
        }

        $query->andWhere($conditions);
    }
}
