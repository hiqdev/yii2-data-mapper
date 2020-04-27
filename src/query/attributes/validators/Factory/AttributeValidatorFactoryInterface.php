<?php

namespace hiqdev\yii\DataMapper\query\attributes\validators\Factory;

use hiqdev\yii\DataMapper\query\attributes\validators\AttributeValidator;

interface AttributeValidatorFactoryInterface
{
    /**
     * @param string|array $definition
     * @return AttributeValidator
     */
    public function createByDefinition($definition): AttributeValidator;
}
