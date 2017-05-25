<?php

namespace hiapi\commands;

use hiapi\repositories\ActiveQuery;

class SearchCommand extends BaseCommand
{
    protected static $handler = SearchHandler::class;

    public $select;
    public $where;
    public $limit;

    public function rules()
    {
        return [
            ['select', 'safe'],
            ['where', 'safe'],
            ['limit', 'number', 'max' => 100],
        ];
    }

    public function getQuery()
    {
        if (is_string($this->select)) {
            $this->select = explode(',', $this->select);
        }

        if (!$this->limit) {
            $this->limit = 25;
        }

        return new ActiveQuery($this->getRecordClass(), $this->getAttributes());
    }
}
