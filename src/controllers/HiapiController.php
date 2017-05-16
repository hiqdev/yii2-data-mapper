<?php
/**
 * HiAPI Yii2 base project for building API
 *
 * @link      https://github.com/hiqdev/hiapi
 * @package   hiapi
 * @license   BSD-3-Clause
 * @copyright Copyright (c) 2017, HiQDev (http://hiqdev.com/)
 */

namespace hiapi\controllers;

class HiapiController extends \yii\web\Controller
{
    public function actionHandle()
    {
        $command = $this->createCommand($this->module->getRequest());

        $bus = $this->module->get('commandBus');

        return $bus->handle($command);
    }

    public function createCommand($request)
    {
    }
}
