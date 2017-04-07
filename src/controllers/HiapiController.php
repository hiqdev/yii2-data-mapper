<?php

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
