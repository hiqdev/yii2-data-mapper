<?php

namespace hiapi\query\attributes;

class UnsupportedOperatorException extends \hiapi\validators\AttributeValidationException
{
    public static function forOperator($operator)
    {
        return new static('Operator ' . $operator . ' is not supported');
    }
}
