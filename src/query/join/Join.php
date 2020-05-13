<?php
/**
 * Data Mapper for Yii2
 *
 * @link      https://github.com/hiqdev/yii2-data-mapper
 * @package   yii2-data-mapper
 * @license   BSD-3-Clause
 * @copyright Copyright (c) 2017-2020, HiQDev (http://hiqdev.com/)
 */

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

    public function getDependencies(): array
    {
        return $this->dependencies;
    }
}
