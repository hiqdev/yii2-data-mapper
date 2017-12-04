<?php
/**
 * Data Mapper for Yii2
 *
 * @link      https://github.com/hiqdev/yii2-data-mapper
 * @package   yii2-data-mapper
 * @license   BSD-3-Clause
 * @copyright Copyright (c) 2017, HiQDev (http://hiqdev.com/)
 */

namespace hiqdev\yii\DataMapper\validators;

class AttributeValidator implements \hiqdev\yii\DataMapper\validators\NormalizerInterface
{
    /**
     * @var \yii\validators\Validator
     */
    private $realValidator;

    public function __construct($realValidator)
    {
        $this->realValidator = $realValidator;
    }

    public function validate($value)
    {
        $result = $this->realValidator->validate($value);

        if ($result !== true) {
            throw \hiqdev\yii\DataMapper\validators\AttributeValidationException::forValue($value, $result);
        }
    }

    public function normalize($value)
    {
        if ($this->realValidator instanceof \hiqdev\yii\DataMapper\validators\NormalizerInterface) {
            $value = $this->realValidator->normalize($value);
        }

        return $value;
    }
}
