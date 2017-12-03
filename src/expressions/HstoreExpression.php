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
class HstoreExpression implements ExpressionInterface
{
    const PARAM_PREFIX = ':hxp';

    /**
     * @var array hash
     */
    protected $hash;

    /**
     * CallExpression constructor.
     */
    public function __construct($hash)
    {
        $this->hash = $hash;
    }

    public function buildExpression(QueryBuilder $builder)
    {
        $params = [];
        $string = $this->buildUsing($builder, $params);

        return new Expression($string, $params);
    }

    /**
     * @inheritdoc
     */
    public function buildUsing(QueryBuilder $queryBuilder, &$params = [])
    {
        $array = [];
        foreach ($this->hash as $key => $value) {
            $array[] = $key;
            $array[] = $value;
        }
        $arrayExp = new ArrayExpression($array, 'text');
        $callExp = new CallExpression('hstore', [$arrayExp]);

        return $callExp->buildUsing($queryBuilder, $params);
    }
}
