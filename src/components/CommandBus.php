<?php

namespace hiapi\components;

use League\Tactician\Handler\CommandHandlerMiddleware;
use League\Tactician\CommandBus as Worker;
use Yii;

class CommandBus extends \yii\base\Component
{
    public $extractor;
    public $locator;
    public $inflector;
    public $middlewares = [];

    protected $worker;

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

    public function getExtractor()
    {
        if (!is_object($this->extractor)) {
            $this->extractor = Yii::createObject($this->extractor);
        }

        return $this->extractor;
    }

    public function getLocator()
    {
        if (!is_object($this->locator)) {
            $this->locator = Yii::createObject($this->locator);
        }

        return $this->locator;
    }

    public function getInflector()
    {
        if (!is_object($this->inflector)) {
            $this->inflector = Yii::createObject($this->inflector);
        }

        return $this->inflector;
    }

    public function registerHandler($handler)
    {
        foreach ($this->middlewares as $middleware) {
            if ($middleware instanceof CommandHandlerMiddleware) {
                return;
            }
        }

        $this->middlewares[] = $handler;
    }


    public function handle($command)
    {
        return $this->getWorker()->handle($command);
    }

    public function getWorker()
    {
        if ($this->worker === null) {
            $this->worker = $this->buildTactician();
        }

        return $this->worker;
    }
}
