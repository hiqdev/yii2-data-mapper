<?php
/**
 * Data Mapper for Yii2
 *
 * @link      https://github.com/hiqdev/yii2-data-mapper
 * @package   yii2-data-mapper
 * @license   BSD-3-Clause
 * @copyright Copyright (c) 2017, HiQDev (http://hiqdev.com/)
 */

namespace hiqdev\yii\DataMapper\validators;

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
