<?php

namespace hiqdev\yii\DataMapper\tests\unit;

use hiqdev\yii\DataMapper\components\EntityManagerInterface;

abstract class BaseRepositoryTest extends \PHPUnit\Framework\TestCase
{
    protected function getRepository(string $entityClass)
    {
        return $this->getEntityManager()->getRepository($entityClass);
    }

    protected function getEntityManager(): EntityManagerInterface
    {
        return $this->getContainer()->get(EntityManagerInterface::class);
    }

    protected function getContainer()
    {
        return class_exists('Yii') ? \Yii::$container : \yii\helpers\Yii::getContainer();
    }
}
