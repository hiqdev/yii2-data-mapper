<?php

namespace hiqdev\yii\DataMapper\query\join;

class Join
{
    protected $table;
    protected $condition;
    /**
     * @var array
     */
    private $dependencies = [];

    public function __construct($table, $condition, array $dependencies = [])
    {
        $this->table = $table;
        $this->condition = $condition;
        $this->dependencies = $dependencies;
    }

    /**
     * @return mixed
     */
    public function getTable()
    {
        return $this->table;
    }

    /**
     * @return mixed
     */
    public function getCondition()
    {
        return $this->condition;
    }

    /**
     * @return array
     */
    public function getDependencies(): array
    {
        return $this->dependencies;
    }
}
