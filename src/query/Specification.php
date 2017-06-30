<?php
/**
 * HiAPI Yii2 base project for building API
 *
 * @link      https://github.com/hiqdev/hiapi
 * @package   hiapi
 * @license   BSD-3-Clause
 * @copyright Copyright (c) 2017, HiQDev (http://hiqdev.com/)
 */

namespace hiapi\query;

use yii\db\QueryTrait;

class Specification
{
    use QueryTrait;

    public $requestedRelations = [];

    public function requestRelation($name)
    {
        $this->requestedRelations[$name] = true; // todo: specification for relation
    }

    /**
     * @param Query $query
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

        return $query;
    }

    /**
     * @param Query $query
     */
    public function applyWhereTo($query)
    {
        foreach ($this->where as $key => $value) {
            foreach ($query->getFields() as $field) {
                if ($field->isApplicable($key)) {
                    $query->andWhere($field->buildCondition($value));
                }
            }
        }
    }
}
