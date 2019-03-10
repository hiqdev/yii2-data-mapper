<?php
/**
 * Data Mapper for Yii2
 *
 * @link      https://github.com/hiqdev/yii2-data-mapper
 * @package   yii2-data-mapper
 * @license   BSD-3-Clause
 * @copyright Copyright (c) 2017-2018, HiQDev (http://hiqdev.com/)
 */

namespace hiqdev\yii\DataMapper\query;

class Specification
{
    use \yii\db\QueryTrait;
    use \yii\db\ActiveQueryTrait;

    public $requestedRelations = [];

    public function requestRelation($name)
    {
        $this->requestedRelations[$name] = true; // todo: specification for relation
    }

    /**
     * @para \yii\db\Query $query
     * @return Query
     */
    public function applyTo($query)
    {
        if ($this->where) {
            $this->applyWhereTo($query);
        }

        if ($this->limit) {
            $query->limit($this->limit);
        }

        if ($this->offset) {
            $query->offset($this->offset);
        }

        return $query;
    }

    /**
     * @param Query $query
     */
    public function applyWhereTo($query)
    {
        $fields = $query->getFields();

        foreach ($this->where as $key => $value) {
            foreach ($fields as $field) {
                if ($field->isApplicable($key)) {
                    $query->andWhere($field->buildCondition($key, $value));
                }
            }
        }
    }
}
