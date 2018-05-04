<?php
/**
 * Data Mapper for Yii2
 *
 * @link      https://github.com/hiqdev/yii2-data-mapper
 * @package   yii2-data-mapper
 * @license   BSD-3-Clause
 * @copyright Copyright (c) 2017-2018, HiQDev (http://hiqdev.com/)
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
