<?php

namespace hiapi\components;

use Yii;

class EntityManager extends \yii\base\Component
{
    public $repositories = [];

    public function getRepository($entityClass)
    {
        if (is_object($entityClass)) {
            $entityClass = get_class($entityClass);
        }

        if (!isset($this->repositories[$entityClass])) {
            throw new \Exception("no repository defined for: $entityClass");
        }

        if (!is_object($this->repositories[$entityClass])) {
            $this->repositories[$entityClass] = Yii::createObject($this->repositories[$entityClass]);
        }

        return $this->repositories[$entityClass];
    }
}
