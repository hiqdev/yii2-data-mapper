<?php
/**
 * HiAPI Yii2 base project for building API
 *
 * @link      https://github.com/hiqdev/hiapi
 * @package   hiapi
 * @license   BSD-3-Clause
 * @copyright Copyright (c) 2017, HiQDev (http://hiqdev.com/)
 */

namespace hiapi\components;

use League\Tactician\CommandBus;
use League\Tactician\Handler\CommandHandlerMiddleware;
use League\Tactician\Middleware;
use Yii;

class TacticianCommandBus extends \yii\base\Component implements CommandBusInterface
{
    /**
     * @var Middleware[]
     */
    protected $middlewares = [];

    /**
     * @var Middleware
     */
    protected $defaultHandler;

    /**
     * @var CommandBus
     */
    protected $realCommandBus;

    public function __construct(Middleware $defaultHandler, array $config = [])
    {
        parent::__construct($config);

        $this->defaultHandler = $defaultHandler;
        $this->realCommandBus = new CommandBus($this->getMiddlewares());
    }

    public function handle($command)
    {
        return $this->realCommandBus->handle($command);
    }

    public function getMiddlewares()
    {
        $this->middlewares = $this->prepareMiddlewares($this->middlewares);

        return $this->middlewares;
    }

    protected function prepareMiddlewares($middlewares)
    {
        foreach ($middlewares as &$middleware) {
            if (!is_object($middleware)) {
                $middleware = Yii::createObject($middleware);
            }
        }

        if (!$this->containsHandler($middlewares)) {
            $middlewares[] = $this->defaultHandler;
        }

        return $middlewares;
    }

    public function setMiddlewares($middlewares)
    {
        $this->middlewares = $middlewares;
    }

    protected function containsHandler($middlewares)
    {
        foreach ($middlewares as $middleware) {
            if ($middleware instanceof CommandHandlerMiddleware) {
                return true;
            }
        }

        return false;
    }
}
