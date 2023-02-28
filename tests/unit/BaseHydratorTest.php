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

use Laminas\Hydrator\HydratorInterface;

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
