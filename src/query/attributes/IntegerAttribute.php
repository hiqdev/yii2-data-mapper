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
