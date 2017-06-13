<?php

namespace hiapi\validators;

use yii\base\Exception;

class AttributeValidationException extends Exception
{
    public function getName()
    {
        return 'Validation exception';
    }

    public static function forValue($value, $message)
    {
        return new self('Value ' . json_encode($value) . ' is invalid');
    }
}
