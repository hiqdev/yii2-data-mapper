<?php

namespace hiapi\components;

use League\Tactician\Handler\CommandHandlerMiddleware;
use League\Tactician\CommandBus as Worker;

class CommandBus extends \uii\base\Component
{
    public $extractor;
    public $locator;
    public $inflector;
    public $middlewares = [];

    protected $bus;

    protected function buildTactician()
    {
        $handler = Yii::createObject(CommandHandlerMiddleware::class, [
            $this->getExtractor(),
            $this->getLocator(),
            $this->getInflector(),
        ]);

        $this->registerHandler($handler);

        return new Worker($this->middlewares);
    }

    public function getLocator()
    {
        if (is_array($this->locator)) {
            $this->locator = Yii::createObject($this->locator);
        }

        return $this->locator;
    }

    public function registerHandler($middleware)
    {
        foreach ($this->middlewares as $middleware)
    }


    public function handle($command)
    {
        return $this->getBus()->handle($command);
    }

    public function getTactician()
    {
        if ($this->bus === null) {
            $this->bus = $this->buildBus();
        }

        return $this->bus;
    }
}
