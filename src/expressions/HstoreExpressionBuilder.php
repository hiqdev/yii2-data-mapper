<?php
/**
 * Data Mapper for Yii2
 *
 * @link      https://github.com/hiqdev/yii2-data-mapper
 * @package   yii2-data-mapper
 * @license   BSD-3-Clause
 * @copyright Copyright (c) 2017-2018, HiQDev (http://hiqdev.com/)
 */

namespace hiqdev\yii\DataMapper\expressions;

use yii\db\ArrayExpression;
use yii\db\ExpressionBuilderInterface;
use yii\db\ExpressionBuilderTrait;
use yii\db\ExpressionInterface;

/**
 * Class HstoreExpressionBuilder.
 *
 * @author Dmytro Naumenko <d.naumenko.a@gmail.com>
 */
class HstoreExpressionBuilder implements ExpressionBuilderInterface
{
    use ExpressionBuilderTrait;

    /**
     * {@inheritdoc}
     * @param HstoreExpression|ExpressionInterface $expression the expression to be built
     */
    public function build(ExpressionInterface $expression, array &$params = [])
    {
        $array = [];
        foreach ($expression->getHash() as $key => $value) {
            $array[] = $key;
            $array[] = $value;
        }
        $arrayExp = new ArrayExpression($array, 'text');
        $callExp = new CallExpression('hstore', [$arrayExp]);

        return $this->queryBuilder->buildExpression($callExp, $params);
    }
}
