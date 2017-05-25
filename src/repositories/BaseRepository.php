<?php
/**
 * HiAPI Yii2 base project for building API
 *
 * @link      https://github.com/hiqdev/hiapi
 * @package   hiapi
 * @license   BSD-3-Clause
 * @copyright Copyright (c) 2017, HiQDev (http://hiqdev.com/)
 */

namespace hiapi\repositories;

use Yii;

abstract class BaseRepository extends \yii\base\Component
{
    public $table;

    public function find(ActiveQuery $query)
    {
        $query->setRepository($this);

        return $query;
    }

    public function getTable()
    {
        return $this->table;
    }

    protected $_recordClass;

    public function setRecordClass($value)
    {
        $this->recordClass = $value;
    }

    public function getRecordClass()
    {
        if ($this->recordClass === null) {
            $this->recordClass = $this->findRecordClass();
        }

        return $this->recordClass;
    }

    public function findRecordClass()
    {
        $parts = explode('\\', get_called_class());

        return implode('\\', $parts);
    }
}
