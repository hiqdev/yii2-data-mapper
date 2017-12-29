<?php
/**
 * Data Mapper for Yii2
 *
 * @link      https://github.com/hiqdev/yii2-data-mapper
 * @package   yii2-data-mapper
 * @license   BSD-3-Clause
 * @copyright Copyright (c) 2017, HiQDev (http://hiqdev.com/)
 */

namespace hiqdev\yii\DataMapper\query;

use yii\db\Query;

class QueryMutator
{
    /**
     * @var Query
     */
    protected $query;

    /**
     * @param Query $query
     */
    public function __construct($query)
    {
        $this->query = $query;
    }

    public function apply(Specification $specification)
    {
        if ($specification->where) {
            $this->query->andWhere($specification->where);
        }

        if ($specification->limit) {
            $this->query->limit($specification->limit);
        }

        return $this;
    }

    public function getQuery()
    {
        return $this->query;
    }
}
