<?php

namespace hiqdev\yii\DataMapper\query\Builder;

/**
 * Interface QueryConditionBuilderFactoryInterface
 *
 * @author Dmytro Naumenko <d.naumenko.a@gmail.com>
 */
interface QueryConditionBuilderFactoryInterface
{
    /**
     * Builds a QueryConditionBuilder
     *
     * @param string $className
     * @psalm-param class-string<QueryConditionBuilderInterface> $className
     * @return QueryConditionBuilderInterface
     */
    public function build(string $className): QueryConditionBuilderInterface;
}
