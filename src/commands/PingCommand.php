<?php

namespace hiapi\commands;

class PingCommand extends BaseCommand
{
    protected $answer = 'pong';

    public $name;
    public $message;
    public $no;

    public function rules()
    {
        return [
            ['name', 'string', 'min' => 6],
            ['message', 'string'],
            ['no', 'number'],
            [['name', 'message'], 'required'],
        ];
    }

    public function setAnswer($value)
    {
        $this->answer = $value;
    }

    public function getAnswer()
    {
        return $this->answer;
    }
}
