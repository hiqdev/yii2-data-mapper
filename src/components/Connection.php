<?php
/**
 * Data Mapper for Yii2
 *
 * @link      https://github.com/hiqdev/yii2-data-mapper
 * @package   yii2-data-mapper
 * @license   BSD-3-Clause
 * @copyright Copyright (c) 2017, HiQDev (http://hiqdev.com/)
 */

namespace hiapi\components;

use hiapi\db\ExpressionInterface;
use yii\db\Expression;
use yii\db\Query;

class Connection extends \yii\db\Connection implements ConnectionInterface
{
    public function createSelect(ExpressionInterface $exp)
    {
        return (new Query())->select($this->buildExpression($exp));
    }

    public function buildExpression($exp)
    {
        $params = [];
        $string = $exp->buildUsing($this->getQueryBuilder(), $params);

        return new Expression($string, $params);
    }
}
