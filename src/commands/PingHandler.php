<?php

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
