<?php

namespace hiapi\components;

use League\Tactician\Handler\CommandHandlerMiddleware;
use League\Tactician\CommandBus as Worker;
use Yii;

class CommandBus extends \yii\base\Component
{
    public $locator;
    public $extractor;
    public $inflector;
    public $middlewares = [];

    protected $handler;
    protected $worker;

    public function handle($command)
    {
        return $this->getWorker()->handle($command);
    }

    public function getWorker()
    {
        if ($this->worker === null) {
            $this->worker = $this->buildWorker();
        }

        return $this->worker;
    }

    protected function buildWorker()
    {
        return new Worker($this->getMiddlewares());
    }

    public function getMiddlewares()
    {
        $this->middlewares = $this->prepareMiddlewares($this->middlewares);
        if (!$this->holdsHandler($this->middlewares)) {
            $this->middlewares[] = $this->getHandler();
        }

        return $this->middlewares;
    }

    public function prepareMiddlewares($middlewares)
    {
        foreach ($middlewares as &$middleware) {
            if (!is_object($middleware)) {
                $middleware = Yii::createObject($middleware);
            }
        }

        return $middlewares;
    }

    public function getHandler()
    {
        if ($this->handler === null) {
            $this->handler = $this->buildHandler();
        }

        return $this->handler;
    }

    public function buildHandler()
    {
        return Yii::createObject(CommandHandlerMiddleware::class, [
            $this->getExtractor(),
            $this->getLocator(),
            $this->getInflector(),
        ]);
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

    public function holdsHandler($middlewares)
    {
        foreach ($middlewares as $middleware) {
            if ($middleware instanceof CommandHandlerMiddleware) {
                return true;
            }
        }

        return false;
    }
}
