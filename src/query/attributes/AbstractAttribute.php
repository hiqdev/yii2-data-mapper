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

abstract class AbstractAttribute implements AttributeInterface
{
    abstract protected function getOperatorRules();

    public function getRuleForOperator(string $operator): array
    {
        $rules = $this->getOperatorRules();

        if (isset($rules[$operator])) {
            return $rules[$operator];
        }

        throw UnsupportedOperatorException::forOperator($operator);
    }

    /**
     * {@inheritdoc}
     */
    public function getSupportedOperators(): array
    {
        return array_keys($this->getOperatorRules());
    }
}
