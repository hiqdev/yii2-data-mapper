<?php

namespace hiapi\db;

use yii\db\Expression;
use yii\db\Query;
use yii\db\QueryBuilder;
use yii\db\QueryInterface;

/**
 * CallExpression represents a SQL function call expression.
 *
 * @author Andrii Vasyliev <sol@hiqdev.com>
 */
class CallExpression implements ExpressionInterface
{
    const PARAM_PREFIX = ':cxp';

    /**
     * @var string function name
     */
    protected $name;

    /**
     * @var array array of function arguments.
     */
    protected $args;

    /**
     * CallExpression constructor.
     */
    public function __construct($name, $args = [])
    {
        $this->name = $name;
        $this->args = $args;
    }

    /**
     * @inheritdoc
     */
    public function buildUsing(QueryBuilder $queryBuilder, &$params = [])
    {
        $args = $this->args;

        if (!is_array($args) && !$args instanceof \Traversable) {
            $args = [$args];
        }

        $placeholders = [];
        foreach ($args as $item) {
            if ($item instanceof Query) {
                list ($sql, $params) = $queryBuilder->build($item, $params);
                $placeholders[] = $sql;
                continue;
            }
            if ($item instanceof ExpressionInterface) {
                $placeholders[] = $item->buildUsing($queryBuilder, $params);
                continue;
            }
            if ($item === null) {
                $placeholders[] = 'NULL';
                continue;
            }

            $placeholders[] = $placeholder = static::PARAM_PREFIX . count($params);
            $params[$placeholder] = $item;
        }

        return $this->buildCallString($this->name, implode(', ', $placeholders));
    }

    protected function buildCallString($name, $args)
    {
        return "$name($args)";
    }
}
