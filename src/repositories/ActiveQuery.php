<?php

namespace hiapi\repositories;

use Yii;

class ActiveQuery extends \yii\db\ActiveQuery
{
    public $repository;

    public function setRepository($value)
    {
        $this->repository = $value;
    }

    public function all($db = null)
    {
        return parent::all($db ?: $this->getDb());
    }

    public function one($db = null)
    {
        return parent::one($db ?: $this->getDb());
    }

    public function getDb()
    {
        return Yii::$app->getDb();
    }
}
