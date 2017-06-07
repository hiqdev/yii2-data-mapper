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
    public function createByModelAttributes($model, $map)
    {
        $result = [];

        foreach ($map as $attributeName => $sql) {
            $attribute = $model->hasAttribute($attributeName)
                ? $model->getAttribute($attributeName)
                : $model->getRelatedAttribute($attributeName);

            $result[] = new Field($attributeName, $sql, $attribute);
        }

        return $result;
    }
}
