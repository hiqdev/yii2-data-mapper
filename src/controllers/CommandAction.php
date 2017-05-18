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

use Yii;

class CommandAction extends \yii\base\Action
{
    protected $_command;

    public function run()
    {
        return Yii::$app->get('commandBus')->handle($this->getCommand());
    }

    public function getCommand()
    {
        if (!is_object($this->_command)) {
            $this->_command = Yii::createObject($this->_command);
        }

        return $this->_command;
    }

    public function setCommand($value)
    {
        $this->_command = $value;
    }
}
