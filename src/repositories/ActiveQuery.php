<?php
/**
 * Data Mapper for Yii2
 *
 * @link      https://github.com/hiqdev/yii2-data-mapper
 * @package   yii2-data-mapper
 * @license   BSD-3-Clause
 * @copyright Copyright (c) 2017-2018, HiQDev (http://hiqdev.com/)
 */

namespace hiqdev\yii\DataMapper\repositories;

use yii\helpers\Yii;

class ActiveQuery extends \yii\db\ActiveQuery
{
    public $repository;

    public function setRepository($value)
    {
        $this->repository = $value;
    }

    public function all($db = null)
    {
        $records = parent::all($db ?: $this->getDb());
        $entities = [];
        foreach ($records as $record) {
            $entities[$record->getPrimaryKey()] = $record->getEntity();
        }

        return $entities;
    }

    public function one($db = null)
    {
        return parent::one($db ?: $this->getDb());
    }

    public function getDb()
    {
        return Yii::$app->getDb();
    }

    /*
        public function prepare($builder)
        {
            $this->prepareSelect();

            return parent::prepare($builder);
        }

        public function prepareSelect()
        {
            $cons = $this->conversions();
            $res = [];
            foreach ($this->select as $field) {
                if (isset($cons[$field])) {
                    $field = $cons[$field];
                }
                $res[] = $field;
            }

            $this->select = $res;
        }

        public function conversions()
        {
            $class = $this->modelClass;

            return $class::conversions();
        }
    */
}
