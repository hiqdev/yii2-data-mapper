<?php
/**
 * HiAPI Yii2 base project for building API
 *
 * @link      https://github.com/hiqdev/hiapi
 * @package   hiapi
 * @license   BSD-3-Clause
 * @copyright Copyright (c) 2017, HiQDev (http://hiqdev.com/)
 */

use yii\db\Query;

namespace hiapi\query;

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
