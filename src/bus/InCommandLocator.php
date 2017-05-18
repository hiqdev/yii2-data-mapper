<?php

namespace hiapi\bus;

use League\Tactician\Handler\Locator\HandlerLocator;

class InCommandLocator implements HandlerLocator
{
    public function getHandlerForCommand($class)
    {
        return $class::getHandler();
    }
}
