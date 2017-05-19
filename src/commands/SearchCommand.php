<?php

namespace hiapi\commands;

class SearchCommand extends BaseCommand
{

    public $select;
    public $where;

    public function rules()
    {
        return [
            ['select', 'safe'],
            ['where', 'safe'],
        ];
    }
}
