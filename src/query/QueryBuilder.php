<?php
declare(strict_types=1);

namespace hiqdev\yii\DataMapper\query;

use RecursiveArrayIterator;
use RecursiveIteratorIterator;

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

        foreach ($this->flattenArray($specification->where) as $key => $value) {
            foreach ($fields as $field) {
                if ($this->queryConditionBuilder->canApply($field, $key)) {
                    $where = $this->queryConditionBuilder->build($field, $key, $value);
                    $this->query->andWhere($where);
                }
            }
        }
    }

    private function flattenArray(array $array, string $concat = '-'): array
    {
        $iterator = new RecursiveIteratorIterator(new RecursiveArrayIterator($array));
        $result = [];
        foreach ($iterator as $leaf) {
            $keys = [];
            foreach (range(0, $iterator->getDepth()) as $depth) {
                $k = $iterator->getSubIterator($depth)->key();
                if (is_numeric($k)) {
                    $result[implode($concat, $keys)][] = $leaf;
                    continue 2;
                }
                $keys[] = $k;
            }
            $result[implode($concat, $keys)] = $leaf;
        }

        return $result;
    }

    public function __clone()
    {
        $this->query = null;
    }
}
