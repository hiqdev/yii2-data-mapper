<?php

namespace hiapi\query\attributes;

class IntegerAttribute extends AbstractAttribute
{
    public function getOperatorRules()
    {
        return [
            'eq' => ['integer'],
            'ne' => ['integer'],
            'gt' => ['integer'],
            'lt' => ['integer'],
            'in' => ['each', 'rule' => ['integer']],
            'ni' => ['each', 'rule' => ['integer']],
        ];
    }
}
