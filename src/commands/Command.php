<?php
/**
 * HiAPI Yii2 base project for building API
 *
 * @link      https://github.com/hiqdev/hiapi
 * @package   hiapi
 * @license   BSD-3-Clause
 * @copyright Copyright (c) 2017, HiQDev (http://hiqdev.com/)
 */

namespace hiapi\commands;

use Yii;

class Command extends \yii\base\Model
{
    protected static $handler;

    public static function getHandler()
    {
        if (!is_object(static::$handler)) {
            static::$handler = Yii::createObject(static::$handler);
        }

        return static::$handler;
    }
}
