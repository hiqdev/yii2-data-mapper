<?php

namespace hiapi\console;

class HiapiController extends \yii\console\Controller
{
    public function actionCatchAll()
    {
        return $this->actionHandle();
    }

    public function actionHandle()
    {
        $command = $this->createCommand($this->module->getRequest());

        $bus = $this->module->get('commandBus');

        return $bus->handle($command);
    }

    public function createCommand($request)
    {
        var_dump($request->getParams());

        return 'hello';
    }
}
