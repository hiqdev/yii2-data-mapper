<?php

namespace hiapi\query;

class Query extends \yii\db\Query
{
    public function apply(Specification $specification)
    {
        if ($specification->where) {
            $this->andWhere($specification->where);
        }

        if ($specification->limit) {
            $this->limit($specification->limit);
        }

        return $this;
    }
}
