<?php

namespace hiapi\query\types;

class UnsupportedOperatorException extends \hiapi\validators\FieldValidationException
{
    public static function forOperator($operator)
    {
        return new static('Operator ' . $operator . ' is not supported');
    }
}
