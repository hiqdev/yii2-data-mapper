<?php
/**
 * Data Mapper for Yii2
 *
 * @link      https://github.com/hiqdev/yii2-data-mapper
 * @package   yii2-data-mapper
 * @license   BSD-3-Clause
 * @copyright Copyright (c) 2017-2018, HiQDev (http://hiqdev.com/)
 */

namespace hiqdev\yii\DataMapper\query;

use yii\db\conditions\ConditionInterface;

interface FieldInterface
{
    /**
     * @return bool
     */
    public function canBeSelected();

    /**
     * @param string $key the attribute name being checked against this filed
     * @return bool
     */
    public function isApplicable($key);

    /**
     * @param string $key
     * @param mixed $value right hand of condition
     * @return array|ConditionInterface Returns either Yii-compatible condition array, or object
     * that implements ConditionInterface. Return empty array if you don't want to add any conditions
     */
    public function buildCondition($key, $value);
}
