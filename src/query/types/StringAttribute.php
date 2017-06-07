<?php

namespace hiapi\query\types;

class StringAttribute extends AbstractAttribute
{
    public function getOperatorRules()
    {
        return [
            'eq' => ['string'],
            'ne' => ['string'],
            'in' => ['each', 'rule' => ['string']],
            'ni' => ['each', 'rule' => ['string']],
            'like' => ['string'],
            'ilike' => ['string'],
        ];
    }
}
