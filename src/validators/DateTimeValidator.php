<?php
/**
 * HiAPI Yii2 base project for building API
 *
 * @link      https://github.com/hiqdev/hiapi
 * @package   hiapi
 * @license   BSD-3-Clause
 * @copyright Copyright (c) 2017, HiQDev (http://hiqdev.com/)
 */

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
