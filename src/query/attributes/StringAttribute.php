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

class StringAttribute extends AbstractAttribute
{
    public function getOperatorRules()
    {
        return [
            'eq' => ['string'],
            'ne' => ['string'],
            'in' => ['each', 'rule' => ['string']],
            'ni' => ['each', 'rule' => ['string']],
            'like' => ['string'],
            'ilike' => ['string'],
        ];
    }
}
