<?php
/**
 * Data Mapper for Yii2
 *
 * @link      https://github.com/hiqdev/yii2-data-mapper
 * @package   yii2-data-mapper
 * @license   BSD-3-Clause
 * @copyright Copyright (c) 2017, HiQDev (http://hiqdev.com/)
 */

namespace hiqdev\yii\DataMapper\query;

use hiqdev\yii\DataMapper\query\attributes\AbstractAttribute;
use hiqdev\yii\DataMapper\validators\AttributeValidationException;
use yii\base\InvalidParamException;

class Field implements FieldInterface
{
    /**
     * @var string
     */
    protected $name;

    /**
     * @var string
     */
    protected $sql;

    /**
     * @var AbstractAttribute
     */
    protected $attribute;

    public function __construct($name, $sql, AbstractAttribute $attribute)
    {
        $this->name = $name;
        $this->sql = $sql;
        $this->attribute = $attribute;
    }

    public function canBeSelected()
    {
        return true;
    }

    public function isApplicable($key)
    {
        return strcasecmp($this->name, $key) === 0;
    }

    /**
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @return string
     */
    public function getSql()
    {
        return $this->sql;
    }

    /**
     * @return AbstractAttribute
     */
    public function getAttribute()
    {
        return $this->attribute;
    }

    /**
     * @param mixed $value
     * @return mixed normalized $value
     * @throws AttributeValidationException when value is not valid
     */
    protected function ensureConditionValueIsValid($value)
    {
        if (is_array($value)) {
            $validator = $this->getAttribute()->getValidatorFor('in');
        } else {
            $validator = $this->getAttribute()->getValidatorFor('eq');
        }

        $value = $validator->normalize($value);
        $validator->ensureIsValid($value);

        return $value;
    }

    /**
     * @param $value
     * @return array
     * @throws AttributeValidationException when value is not valid
     */
    public function buildCondition($value)
    {
        return [$this->getSql() => $this->ensureConditionValueIsValid($value)];
    }
}
