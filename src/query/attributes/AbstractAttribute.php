<?php

namespace hiapi\query\attributes;

abstract class AbstractAttribute implements AttributeInterface
{
    abstract protected function getOperatorRules();

    public function getRuleForOperator($operator)
    {
        $rules = $this->getOperatorRules();

        if (isset($rules[$operator])) {
            return $rules[$operator];
        }

        throw UnsupportedOperatorException::forOperator($operator);
    }
}
