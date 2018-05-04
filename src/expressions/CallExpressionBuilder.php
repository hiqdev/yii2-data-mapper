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

use yii\db\ExpressionBuilderInterface;
use yii\db\ExpressionBuilderTrait;
use yii\db\ExpressionInterface;

/**
 * Class CallExpressionBuilder.
 *
 * @author Dmytro Naumenko <d.naumenko.a@gmail.com>
 */
class CallExpressionBuilder implements ExpressionBuilderInterface
{
    use ExpressionBuilderTrait;

    /**
     * {@inheritdoc}
     * @param CallExpression|ExpressionInterface $expression the expression to be built
     */
    public function build(ExpressionInterface $expression, array &$params = [])
    {
        $args = $expression->getArguments();

        $placeholders = [];
        foreach ($args as $argument) {
            if ($argument instanceof ExpressionInterface) {
                $placeholders[] = $this->queryBuilder->buildExpression($argument, $params);
                continue;
            }

            $placeholders[] = $this->queryBuilder->bindParam($argument, $params);
        }

        return $this->buildCallString($expression->getProcedureName(), implode(', ', $placeholders));
    }

    protected function buildCallString($name, $args)
    {
        return "$name($args)";
    }
}
