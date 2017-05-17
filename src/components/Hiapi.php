<?php

namespace hiapi\components;

use yii\base\Request;

class Hiapi extends \yii\base\Component
{
    public $commandNamespaces = [];

    public function createCommand(Request $request)
    {
        $parts = explode('/', trim($request->getUrl()));
        var_dump($parts);
        var_dump($this->commandNamespaces);
        die;
    }
}
