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

use Exception;
use hiqdev\DataMapper\Repository\BaseRepository;
use hiqdev\DataMapper\Repository\EntityManagerInterface;
use PHPUnit\Framework\TestCase;
use yii\helpers\Yii;

abstract class BaseRepositoryTestCase extends TestCase
{
    /**
     * @template T of BaseRepository
     * @psalm-param class-string<T> $entityClass
     * @return T
     * @throws Exception
     */
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
        return class_exists('Yii') ? \Yii::$container : Yii::getContainer();
    }
}
