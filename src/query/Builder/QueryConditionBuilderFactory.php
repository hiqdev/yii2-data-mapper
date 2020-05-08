<?php
declare(strict_types=1);

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
