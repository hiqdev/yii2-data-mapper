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

use hiqdev\yii\DataMapper\query\attributes\AttributeInterface;
use yii\db\ExpressionInterface;

interface FieldInterface
{
    /**
     * Provides a field name
     *
     * @return string
     */
    public function getName(): string;

    /**
     * @return AttributeInterface
     */
    public function getAttribute(): AttributeInterface;

    /**
     * Provides SQL statement that represents the selected field.
     * The statement can be used for both
     *
     * @return string|ExpressionInterface
     */
    public function getSql();

    /**
     * @return bool
     */
    public function canBeSelected(): bool;
}
