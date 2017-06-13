<?php

namespace hiapi\query\attributes;

use hiapi\validators\DateTimeValidator;

class DateTimeAttribute extends AbstractAttribute
{
    protected function getOperatorRules()
    {
        return [
            'eq' => [DateTimeValidator::class],
        ];
    }
}
