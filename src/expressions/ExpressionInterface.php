<?php
/**
 * Data Mapper for Yii2
 *
 * @link      https://github.com/hiqdev/yii2-data-mapper
 * @package   yii2-data-mapper
 * @license   BSD-3-Clause
 * @copyright Copyright (c) 2017, HiQDev (http://hiqdev.com/)
 */

namespace hiapi\db;

use yii\db\QueryBuilder;

/**
 * Interface ExpressionInterface provides API for a DB expression
 * that does not need additional escaping or quoting.
 *
 * The database abstraction layer of Yii framework supports objects that implement this
 * interface and will use them as for passing raw SQL expressions.
 *
 * The default implementation is a class [[Expression]].
 *
 * @author Dmytro Naumenko <d.naumenko.a@gmail.com>
 * @since 2.0.13
 */
interface ExpressionInterface
{
    /**
     * Method builds the raw SQL expression.
     *
     * @param QueryBuilder $queryBuilder the QueryBuilder that intends to use this expression
     * @param array $params the binding parameters
     * @return string the raw SQL that will not be additionally escaped or quoted
     */
    public function buildUsing(QueryBuilder $queryBuilder, &$params = []);
}