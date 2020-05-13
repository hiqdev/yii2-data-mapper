<?php

declare(strict_types=1);
/**
 * Data Mapper for Yii2
 *
 * @link      https://github.com/hiqdev/yii2-data-mapper
 * @package   yii2-data-mapper
 * @license   BSD-3-Clause
 * @copyright Copyright (c) 2017-2020, HiQDev (http://hiqdev.com/)
 */

namespace hiqdev\yii\DataMapper\query\Builder;

use Psr\Container\ContainerInterface;

final class QueryConditionBuilderFactory implements QueryConditionBuilderFactoryInterface
{
    private ContainerInterface $container;

    public function __construct(ContainerInterface $container)
    {
        $this->container = $container;
    }

    public function build(string $className): QueryConditionBuilderInterface
    {
        return $this->container->get($className);
    }
}
