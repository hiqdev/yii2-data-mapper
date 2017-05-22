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

abstract class BaseCommand extends \yii\base\Model
{
    protected static $handler;

    public static function getHandler()
    {
        if (!is_object(static::$handler)) {
            static::$handler = Yii::createObject(static::$handler);
        }

        return static::$handler;
    }

    public static function setHandler($value)
    {
        static::$handler = $value;
    }

    public function loadFromRequest($request)
    {
        $this->load($this->getRequestData($request), '');
        $this->validate();

        return $this->hasErrors() ? $this->getErrors() : null;
    }

    public function getRequestData($request)
    {
        $get = $request->get();
        $post = $request->post();

        return array_merge($get, $post);
    }
}
