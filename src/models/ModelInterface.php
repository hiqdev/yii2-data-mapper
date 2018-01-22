<?php
/**
 * API for Billing
 *
 * @link      https://github.com/hiqdev/billing-hiapi
 * @package   billing-hiapi
 * @license   BSD-3-Clause
 * @copyright Copyright (c) 2017, HiQDev (http://hiqdev.com/)
 */

namespace hiqdev\yii\DataMapper\models;

interface ModelInterface
{
    public function attributes();

    public function hasRelation($name);

    public function getRelation($name);

    public function relations();

    public function hasAttribute($name);

    public function getAttribute($name);
}
