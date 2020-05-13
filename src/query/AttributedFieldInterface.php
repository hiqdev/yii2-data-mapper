<?php
/**
 * Data Mapper for Yii2
 *
 * @link      https://github.com/hiqdev/yii2-data-mapper
 * @package   yii2-data-mapper
 * @license   BSD-3-Clause
 * @copyright Copyright (c) 2017-2020, HiQDev (http://hiqdev.com/)
 */

namespace hiqdev\yii\DataMapper\query;

use hiqdev\yii\DataMapper\query\attributes\AttributeInterface;

/**
 * Interface AttributedFieldInterface marks a field with the attribute
 *
 * @author Dmytro Naumenko <d.naumenko.a@gmail.com>
 */
interface AttributedFieldInterface extends FieldInterface
{
    /**
     * The returns attribute, that describes the value type.
     */
    public function getAttribute(): AttributeInterface;
}
