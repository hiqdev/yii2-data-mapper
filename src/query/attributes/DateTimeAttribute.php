<?php
/**
 * Data Mapper for Yii2
 *
 * @link      https://github.com/hiqdev/yii2-data-mapper
 * @package   yii2-data-mapper
 * @license   BSD-3-Clause
 * @copyright Copyright (c) 2017, HiQDev (http://hiqdev.com/)
 */

namespace hiqdev\yii\DataMapper\query\attributes;

use hiqdev\yii\DataMapper\validators\DateTimeValidator;

class DateTimeAttribute extends AbstractAttribute
{
    protected function getOperatorRules()
    {
        return [
            'eq' => [DateTimeValidator::class],
        ];
    }
}
