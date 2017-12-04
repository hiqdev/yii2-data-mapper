<?php
/**
 * Data Mapper for Yii2
 *
 * @link      https://github.com/hiqdev/yii2-data-mapper
 * @package   yii2-data-mapper
 * @license   BSD-3-Clause
 * @copyright Copyright (c) 2017, HiQDev (http://hiqdev.com/)
 */

namespace hiqdev\yii\DataMapper\query\attributes;

class IntegerAttribute extends AbstractAttribute
{
    public function getOperatorRules()
    {
        return [
            'eq' => ['integer'],
            'ne' => ['integer'],
            'gt' => ['integer'],
            'lt' => ['integer'],
            'in' => ['each', 'rule' => ['integer']],
            'ni' => ['each', 'rule' => ['integer']],
        ];
    }
}
