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

/**
 * Class FloatAttribute.
 *
 * @author Dmytro Naumenko <d.naumenko.a@gmail.com>
 */
class FloatAttribute extends AbstractAttribute
{
    public function getOperatorRules()
    {
        return [
            'eq' => ['float'],
            'ne' => ['float'],
            'gt' => ['float'],
            'lt' => ['float'],
            'in' => ['each', 'rule' => ['float']],
            'ni' => ['each', 'rule' => ['float']],
        ];
    }
}
