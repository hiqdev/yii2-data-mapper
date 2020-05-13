<?php
/**
 * Data Mapper for Yii2
 *
 * @link      https://github.com/hiqdev/yii2-data-mapper
 * @package   yii2-data-mapper
 * @license   BSD-3-Clause
 * @copyright Copyright (c) 2017-2020, HiQDev (http://hiqdev.com/)
 */

namespace hiqdev\yii\DataMapper\query;

use yii\db\ExpressionInterface;

/**
 * Class FilterField marks a field that can not be selected, but can
 * produce a condition, used for filtering
 *
 * @author Dmytro Naumenko <d.naumenko.a@gmail.com>
 */
interface FieldConditionBuilderInterface
{
    /**
     * @param mixed $value a value for the filter
     * @return array|string|ExpressionInterface a filter-string in Yii-suitable format
     */
    public function buildCondition(string $operator, string $attributeName, $value);
}
