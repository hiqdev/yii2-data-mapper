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
use ReflectionClass;
use yii\base\UnknownClassException;

class NearbyHandlerLocator implements HandlerLocator
{
    public function getHandlerForCommand($class)
    {
        $reflector = new ReflectionClass($class);
        $dir = dirname($reflector->getFileName());

        $commandName = $reflector->getShortName();
        $handlerName = substr($commandName, 0, strrpos($commandName, 'Command')) . 'Handler';

        $path = $dir . DIRECTORY_SEPARATOR . $handlerName . '.php';
        if (!is_file($path)) {
            throw new UnknownClassException('Class "' . $handlerName . '" was not found near to ' . $reflector->getName());
        }

        $className = $reflector->getNamespaceName() . '\\' . $handlerName;
        return new $className();
    }
}
