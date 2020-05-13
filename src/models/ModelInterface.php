<?php
/**
 * Data Mapper for Yii2
 *
 * @link      https://github.com/hiqdev/yii2-data-mapper
 * @package   yii2-data-mapper
 * @license   BSD-3-Clause
 * @copyright Copyright (c) 2017-2020, HiQDev (http://hiqdev.com/)
 */

namespace hiqdev\yii\DataMapper\models;

use hiqdev\yii\DataMapper\query\attributes\AbstractAttribute;
use hiqdev\yii\DataMapper\query\attributes\AttributeInterface;

interface ModelInterface
{
    /**
     * @psalm-return array<string, class-string<self>>
     */
    public function relations();

    /**
     * @psalm-return class-string<self>
     * // TODO: handle one-to-many relations
     */
    public function getRelation(string $name);

    public function hasRelation(string $name): bool;

    /**
     * @return array<string, class-string<AttributeInterface>>
     */
    public function attributes();

    /**
     * @psalm-return AttributeInterface
     */
    public function getAttribute(string $name): AbstractAttribute;

    public function hasAttribute(string $name): bool;
}
