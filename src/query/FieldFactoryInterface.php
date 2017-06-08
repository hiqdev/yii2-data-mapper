<?php
namespace hiapi\query;

interface FieldFactoryInterface
{
    /**
     * @param $model
     * @param $map
     * @return Field[]
     */
    public function createByModelAttributes($model, $map);

    public function getHierarchySeparator(): string;
}
