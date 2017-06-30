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
