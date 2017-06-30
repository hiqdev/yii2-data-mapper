<?php

namespace hiapi\query\attributes;

use hiapi\validators\AttributeValidatorFactory;

abstract class AbstractAttribute implements AttributeInterface
{
    /**
     * @var AttributeValidatorFactory
     */
    private $validatorFactory;

    public function __construct(AttributeValidatorFactory $validatorFactory)
    {
        $this->validatorFactory = $validatorFactory;
    }

    abstract protected function getOperatorRules();

    public function getRuleForOperator($operator)
    {
        $rules = $this->getOperatorRules();

        if (isset($rules[$operator])) {
            return $rules[$operator];
        }

        throw UnsupportedOperatorException::forOperator($operator);
    }

    public function getValidatorFor($operator)
    {
        $rule = $this->getRuleForOperator($operator);

        return $this->validatorFactory->createByDefinition($rule);
    }
}
