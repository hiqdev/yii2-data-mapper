<?php

namespace hiqdev\yii\DataMapper\query;

use hiqdev\yii\DataMapper\query\attributes\validators\AttributeValidationException;

/**
 * Interface QueryConditionBuilderInterface described a class
 * that is response for creating conditions on the specific Field
 *
 * @author Dmytro Naumenko <d.naumenko.a@gmail.com>
 */
interface QueryConditionBuilderInterface
{
    /**
     * Builds a condition in one of the Yii-compatible `where` formats.
     *
     * @param FieldInterface $field
     * @param string $attribute
     * @param $value
     * @return mixed
     * @throws AttributeValidationException in the attribute value does not pass the field type validation
     */
    public function build(FieldInterface $field, string $attribute, $value);

    /**
     * Checks, whether the $field is responsible for $attribute filter.
     *
     * @param FieldInterface $field
     * @param string $attribute
     * @return bool
     */
    public function canApply(FieldInterface $field, string $attribute): bool;
}
