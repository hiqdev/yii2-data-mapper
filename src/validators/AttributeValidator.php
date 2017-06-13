<?php

namespace hiapi\validators;

class AttributeValidator implements \hiapi\validators\NormalizerInterface
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
            throw \hiapi\validators\AttributeValidationException::forValue($value, $result);
        }
    }

    public function normalize($value)
    {
        if ($this->realValidator instanceof \hiapi\validators\NormalizerInterface) {
            $value = $this->realValidator->normalize($value);
        }

        return $value;
    }
}
