<?php
declare(strict_types=1);

namespace hiqdev\yii\DataMapper\query;

use hiqdev\yii\DataMapper\query\Builder\QueryConditionBuilderInterface;
use yii\helpers\ArrayHelper;

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
     * @var QueryConditionBuilderInterface
     */
    private QueryConditionBuilderInterface $queryConditionBuilder;

    public function __construct(QueryConditionBuilderInterface $queryConditionBuilder)
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

        if ($specification->orderBy) {
            $this->applyOrderBy($specification);
        }

        if ($specification->limit) {
            $this->query->limit($specification->limit);
        }

        if ($specification->offset) {
            $this->query->offset($specification->offset);
        }

        return $this;
    }

    private function applyOrderBy(Specification $specification): void
    {
        // TODO convert field names appropriately
        $this->query->orderBy($specification->orderBy);
    }

    private function applyWhereFrom(Specification $specification): void
    {
        $fields = $this->query->getFields();

        foreach ($flat = $this->flattenArray($specification->where) as $key => $value) {
            foreach ($fields as $field) {
                if ($this->queryConditionBuilder->canApply($field, (string)$key)) {
                    $where = $this->queryConditionBuilder->build($field, $key, $value);
                    $this->query->andWhere($where);
                }
            }
        }
    }

    /**
     * Takes a tree structure of filters e.g.
     *
     * ```
     * [
     *    'id' => 42,
     *    'type' => [
     *       'id' => 13
     *    ]
     * ]
     * ```
     *
     * and flattens it to
     *
     * ```
     * [
     *   'id' => 42,
     *   'type-id' => 13,
     * ]
     * ```
     *
     * @param array $array
     * @param array $parents
     * @param string $concat
     * @return array
     */
    private function flattenArray(array $array, array $parents = [], string $concat = '-'): array
    {
        $result = [];

        foreach ($array as $key => $value) {
            $tree = array_merge($parents, [$key]);
            $flatKey = implode($concat, $tree);
            if (is_array($value)) {
                if (empty($value)) {
                    // Empty array condition must be kept and be transformed to `false` for DBMS.
                    $result[$flatKey] = $value;
                    continue;
                }

                if (ArrayHelper::isAssociative($value)) {
                    $result = array_merge($result, $this->flattenArray($value, $tree));
                    continue;
                }
            }

            $result[$flatKey] = $value;
        }

        return $result;
    }

    public function __clone()
    {
        $this->query = null;
    }
}
