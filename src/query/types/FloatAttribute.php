<?php

namespace hiapi\query\types;

/**
 * Class FloatAttribute
 *
 * @author Dmytro Naumenko <d.naumenko.a@gmail.com>
 */
class FloatAttribute extends AbstractAttribute
{
    public function getOperatorRules()
    {
        return [
            'eq' => ['float'],
            'ne' => ['float'],
            'gt' => ['float'],
            'lt' => ['float'],
            'in' => ['each', 'rule' => ['float']],
            'ni' => ['each', 'rule' => ['float']],
        ];
    }
}
