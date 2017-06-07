<?php

namespace hiapi\validators;

use yii\base\Exception;

class FieldValidationException extends Exception
{
    public function getName()
    {
        return 'Validation exception';
    }
}
