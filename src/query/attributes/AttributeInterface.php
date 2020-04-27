<?php
/**
 * Data Mapper for Yii2
 *
 * @link      https://github.com/hiqdev/yii2-data-mapper
 * @package   yii2-data-mapper
 * @license   BSD-3-Clause
 * @copyright Copyright (c) 2017-2018, HiQDev (http://hiqdev.com/)
 */

namespace hiqdev\yii\DataMapper\query\attributes;

interface AttributeInterface
{
    /**
     * @param string $operator
     * @return array
     * @throws UnsupportedOperatorException when operator is not supported
     */
    public function getRuleForOperator(string $operator): array;

    /**
     * @return string[]
     */
    public function getSupportedOperators(): array;
}
