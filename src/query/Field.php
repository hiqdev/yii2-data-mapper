<?php
/**
 * Data Mapper for Yii2
 *
 * @link      https://github.com/hiqdev/yii2-data-mapper
 * @package   yii2-data-mapper
 * @license   BSD-3-Clause
 * @copyright Copyright (c) 2017-2018, HiQDev (http://hiqdev.com/)
 */

namespace hiqdev\yii\DataMapper\query;

use hiqdev\yii\DataMapper\query\attributes\AbstractAttribute;
use hiqdev\yii\DataMapper\query\attributes\AttributeInterface;
use yii\db\ExpressionInterface;

class Field implements FieldInterface, SQLFieldInterface, AttributedFieldInterface
{
    /**
     * @var string field (attribute) name
     */
    protected $name;

    /**
     * @var string|ExpressionInterface representing column name in SQL
     */
    protected $sql;

    /**
     * @var AbstractAttribute
     */
    protected $attribute;

    /**
     * Field constructor.
     *
     * @param string $name
     * @param string $sql
     * @param AbstractAttribute $attribute
     */
    public function __construct($name, $sql, AbstractAttribute $attribute)
    {
        $this->name = $name;
        $this->sql = $sql;
        $this->attribute = $attribute;
    }

    public function canBeSelected(): bool
    {
        return true;
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    public function getSql()
    {
        return $this->sql;
    }

    /**
     * @return AbstractAttribute
     */
    public function getAttribute(): AttributeInterface
    {
        return $this->attribute;
    }
}
