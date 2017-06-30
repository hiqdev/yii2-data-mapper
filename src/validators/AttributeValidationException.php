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
