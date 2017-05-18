<?php

namespace hiapi\components;

use League\Tactician\Handler\Locator\HandlerLocator;

class InCommandLocator implements HandlerLocator
{
    public function getHandlerForCommand($class)
    {
        return $class::getHandler();
    }
}
