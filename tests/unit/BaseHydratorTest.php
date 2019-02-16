<?php

namespace hiqdev\yii\DataMapper\tests\unit;

use Zend\Hydrator\HydratorInterface;

abstract class BaseHydratorTest extends \PHPUnit\Framework\TestCase
{
    protected function getHydrator(): HydratorInterface
    {
        return $this->getContainer()->get(HydratorInterface::class);
    }

    protected function getContainer()
    {
        return class_exists('Yii') ? \Yii::$container : \yii\helpers\Yii::getContainer();
    }
}
