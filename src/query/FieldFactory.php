<?php

namespace hiapi\query;

use hiqdev\billing\hiapi\models\ModelInterface;

class FieldFactory implements FieldFactoryInterface
{
    /**
     * @param ModelInterface $model
     * @param $map
     * @return Field[]
     */
    public function createByModelAttributes($model, $map, $parentRelations = [])
    {
        $result = [];

        foreach ($map as $attributeName => $definition) {
            if (!is_array($definition)) {
                $name = implode(array_merge($parentRelations, [$attributeName]), $this->getHierarchySeparator());
                $result[] = new Field($name, $definition, $model->getAttribute($attributeName));
            } else {
                $relationClass = $model->getRelation($attributeName);
                $result = array_merge($result, $this->createByModelAttributes(
                    new $relationClass,
                    $definition,
                    array_merge($parentRelations, [$attributeName])
                ));
            }
        }

        return $result;
    }

    public function getHierarchySeparator(): string
    {
        return '-';
    }
}
