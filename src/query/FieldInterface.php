<?php
/**
 * HiAPI Yii2 base project for building API
 *
 * @link      https://github.com/hiqdev/hiapi
 * @package   hiapi
 * @license   BSD-3-Clause
 * @copyright Copyright (c) 2017, HiQDev (http://hiqdev.com/)
 */

namespace hiapi\query;

interface FieldInterface
{
    public function canBeSelected();

    public function isApplicable($key);

    /**
     * @return array
     */
    public function buildCondition($value);
}
