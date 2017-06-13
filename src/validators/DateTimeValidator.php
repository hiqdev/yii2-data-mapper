<?php

namespace hiapi\validators;

use yii\validators\DateValidator;

class DateTimeValidator extends DateValidator implements NormalizerInterface
{
    public $type = self::TYPE_DATETIME;

    public $format = 'php:Y-m-d H:i:s';

    public function normalize($value)
    {
        return date('Y-m-d H:i:s', strtotime($value));
    }
}
