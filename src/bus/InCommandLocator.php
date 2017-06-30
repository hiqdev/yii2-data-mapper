<?php
/**
 * HiAPI Yii2 base project for building API
 *
 * @link      https://github.com/hiqdev/hiapi
 * @package   hiapi
 * @license   BSD-3-Clause
 * @copyright Copyright (c) 2017, HiQDev (http://hiqdev.com/)
 */

namespace hiapi\bus;

use League\Tactician\Handler\Locator\HandlerLocator;

class InCommandLocator implements HandlerLocator
{
    public function getHandlerForCommand($class)
    {
        return $class::getHandler();
    }
}
