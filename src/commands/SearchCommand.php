<?php

namespace hiapi\commands;

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

    public function getAttributes()
    {
        $this->fixAttributes();

        return parent::getAttributes();
    }

    public function fixAttributes()
    {
        if (is_string($this->select)) {
            $this->select = explode(',', $this->select);
        }

        if (!$this->limit) {
            $this->limit = 25;
        }
    }
}
