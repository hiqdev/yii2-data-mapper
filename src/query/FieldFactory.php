<?php
/**
 * Data Mapper for Yii2
 *
 * @link      https://github.com/hiqdev/yii2-data-mapper
 * @package   yii2-data-mapper
 * @license   BSD-3-Clause
 * @copyright Copyright (c) 2017, HiQDev (http://hiqdev.com/)
 */

namespace hiapi\query;

use hiqdev\billing\hiapi\models\ModelInterface;

class FieldFactory implements FieldFactoryInterface
{
    /**
     * @param ModelInterface $model
     * @param $map
     * @param string[] parent attribute names
     * @return Field[]
     */
    public function createByModelAttributes($model, $map, array $parents = [])
    {
        $result = [];

        foreach ($map as $attributeName => $definition) {
            if (!is_array($definition)) {
                $result[] = is_object($definition) ? $definition : $this->buildField($model, $attributeName, $definition, $parents);
            } else {
                $relationClass = $model->getRelation($attributeName);
                $result = array_merge($result, $this->createByModelAttributes(
                    new $relationClass(),
                    $definition,
                    array_merge($parents, [$attributeName])
                ));
            }
        }

        return $result;
    }

    protected function buildField($model, $attributeName, $sql, array $parents)
    {
        array_push($parents, $attributeName);
        $name = implode($this->getHierarchySeparator(), $parents);

        return new Field($name, $sql, $model->getAttribute($attributeName));
    }

    public function getHierarchySeparator()
    {
        return '-';
    }
}
