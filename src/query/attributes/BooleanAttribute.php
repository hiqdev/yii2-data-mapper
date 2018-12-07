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

class BooleanAttribute extends AbstractAttribute
{
    public function getOperatorRules()
    {
        return [
            'eq' => ['boolean'],
            'ne' => ['boolean'],
            'in' => ['each', 'rule' => ['boolean']],
            'ni' => ['each', 'rule' => ['boolean']],
        ];
    }
}
