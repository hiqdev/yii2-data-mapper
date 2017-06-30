<?php
/**
 * HiAPI Yii2 base project for building API
 *
 * @link      https://github.com/hiqdev/hiapi
 * @package   hiapi
 * @license   BSD-3-Clause
 * @copyright Copyright (c) 2017, HiQDev (http://hiqdev.com/)
 */

namespace hiapi\query\attributes;

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
