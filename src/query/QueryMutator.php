<?php


namespace hiapi\query;

class QueryMutator
{
    /**
     * @var \yii\db\Query
     */
    protected $query;

    /**
     * QueryMutator constructor.
     * @param \yii\db\Query $query
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
