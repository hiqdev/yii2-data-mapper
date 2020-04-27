<?php
declare(strict_types=1);

namespace hiqdev\yii\DataMapper\query;

/**
 * Class QueryBuilder should be normally pre-configured with dependencies
 * and cloned for each new Query it processes.
 *
 * @author Dmytro Naumenko <d.naumenko.a@gmail.com>
 */
final class QueryBuilder
{
    /**
     * @var Query|null
     */
    private ?Query $query;
    /**
     * @var QueryConditionBuilder
     */
    private QueryConditionBuilder $queryConditionBuilder;

    public function __construct(QueryConditionBuilder $queryConditionBuilder)
    {
        $this->queryConditionBuilder = $queryConditionBuilder;
    }

    public function setQuery(Query $query): self
    {
        $this->query = $query;

        return $this;
    }

    public function apply(Specification $specification): self
    {
        if ($specification->where) {
            $this->applyWhereFrom($specification);
        }

        if ($specification->limit) {
            $this->query->limit($specification->limit);
        }

        if ($specification->offset) {
            $this->query->offset($specification->offset);
        }

        return $this;
    }

    private function applyWhereFrom(Specification $specification): void
    {
        $fields = $this->query->getFields();

        foreach ($specification->where as $key => $value) {
            foreach ($fields as $field) {
                if ($this->queryConditionBuilder->canApply($field, $key)) {
                    $where = $this->queryConditionBuilder->build($field, $key, $value);
                    $this->query->andWhere($where);
                }
            }
        }
    }

    public function __clone()
    {
        $this->query = null;
    }
}
