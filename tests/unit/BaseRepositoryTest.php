<?php
/**
 * Data Mapper for Yii2
 *
 * @link      https://github.com/hiqdev/yii2-data-mapper
 * @package   yii2-data-mapper
 * @license   BSD-3-Clause
 * @copyright Copyright (c) 2017-2020, HiQDev (http://hiqdev.com/)
 */

namespace hiqdev\yii\DataMapper\tests\unit;

use hiqdev\DataMapper\Repository\EntityManagerInterface;

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
