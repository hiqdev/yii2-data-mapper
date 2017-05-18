<?php

namespace hiapi\bus;

use League\Tactician\Middleware;
use Yii;

class LoadMiddleware implements Middleware
{
    public function execute($command, callable $next)
    {
        $error = $command->loadFromRequest(Yii::$app->request);
        if ($error) {
            throw new \Exception('failed load command, error: ' . var_export($error, true));
        }

        return $next($command);
    }
}
