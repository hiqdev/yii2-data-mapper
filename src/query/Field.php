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
use hiqdev\yii\DataMapper\query\attributes\validators\AttributeValidationException;
use yii\db\ExpressionInterface;

class Field implements FieldInterface
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

    /**
     * @param string $operator
     * @param mixed $value
     * @throws AttributeValidationException when value is not valid
     * @return mixed normalized $value
     */
    protected function ensureConditionValueIsValid($operator, $value)
    {
        $validator = $this->getAttribute()->getValidatorFor($operator);

        $value = $validator->normalize($value);
        $validator->ensureIsValid($value);

        return $value;
    }

    /**
     * // TODO: create ConditionBuilder?
     * @param $key
     * @param $value
     * @throws AttributeValidationException when value is not valid
     * @return array
     */
    public function buildCondition($key, $value)
    {
        [$operator, $attribute] = $this->parseFilterKey($key);

        if (is_array($value)) {
            return [$this->getSql() => $this->ensureConditionValueIsValid('in', $value)];
        }

        $operatorMap = [
            'eq' => '=',
            'ne' => '!=',
        ];

        return [$operatorMap[$operator] ?? $operator, $this->getSql(), $this->ensureConditionValueIsValid($operator, $value)];
    }
}
