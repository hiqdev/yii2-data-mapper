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
use yii\helpers\Inflector;

abstract class BaseController extends \yii\web\Controller
{
    public function behaviors()
    {
        return [
            [
                'class' => \hiapi\filters\ContentNegotiator::class,
            ],
        ];
    }

    protected $_actions;

    public function actions()
    {
        if ($this->_actions === null) {
            $this->_actions = $this->findActions();
        }

        return $this->_actions;
    }

    public function findActions()
    {
        $actions = [];
        foreach ($this->commands() as $name => $config) {
            $actions[$name] = [
                'class' => CommandAction::class,
                'command' => $config ?: $this->getCommandClass($name),
            ];
        }

        return $actions;
    }

    protected $_scannedCommands;

    public function commands()
    {
        if ($this->_scannedCommands === null) {
            $this->_scannedCommands = $this->scanCommands($this->getCommandNamespace());
        }

        return $this->_scannedCommands;
    }

    public function scanCommands($namespace)
    {
        $dir = Yii::getAlias('@' . strtr($namespace, '\\', '/'));
        if (!is_dir($dir)) {
            return [];
        }

        $commands = [];
        $files = scandir($dir);
        foreach ($files as $file) {
            if (substr_compare($file, 'Command.php', -11, 11) === 0) {
                $command = Inflector::camel2id(substr(basename($file), 0, -11));
                $commands[$command] = '';
            }
        }

        return $commands;
    }

    public function getCommandClass($name)
    {
        return $this->getCommandNamespace() . '\\' . Inflector::id2camel($name) . 'Command';
    }

    protected $_commandNamespace;

    public function getCommandNamespace()
    {
        if ($this->_commandNamespace === null) {
            $this->_commandNamespace = $this->findCommandNamespace();
        }

        return $this->_commandNamespace;
    }

    public function findCommandNamespace()
    {
        $nss = explode('\\', get_called_class());
        array_pop($nss);
        array_pop($nss);
        array_push($nss, 'commands');
        array_push($nss, $this->id);

        return implode('\\', $nss);
    }
}
