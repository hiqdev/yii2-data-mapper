<?php
/**
 * HiAPI Yii2 base project for building API
 *
 * @link      https://github.com/hiqdev/hiapi
 * @package   hiapi
 * @license   BSD-3-Clause
 * @copyright Copyright (c) 2017, HiQDev (http://hiqdev.com/)
 */

namespace hiapi\commands;

class PingHandler
{
    public $pong;
    public $command;

    public function handle(PingCommand $command)
    {
        $this->command = $command;
        $this->pong = $command->getAnswer();

        return $this;
    }
}
