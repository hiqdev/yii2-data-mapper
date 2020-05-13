<?php
/**
 * Data Mapper for Yii2
 *
 * @link      https://github.com/hiqdev/yii2-data-mapper
 * @package   yii2-data-mapper
 * @license   BSD-3-Clause
 * @copyright Copyright (c) 2017-2020, HiQDev (http://hiqdev.com/)
 */

namespace hiqdev\yii\DataMapper\query\attributes\validators;

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
