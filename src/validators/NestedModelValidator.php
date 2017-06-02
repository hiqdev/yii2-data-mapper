<?php

namespace hiapi\validators;

use yii\base\InvalidParamException;
use yii\base\Model;
use yii\validators\Validator;

class NestedModelValidator extends Validator
{
    /**
     * @param Model $model
     * @return array|null
     */
    protected function validateValue($model)
    {
        if (!$model instanceof Model) {
            throw new InvalidParamException('Passed value must be instance of Model');
        }

        if (!$model->validate()) {
            return [reset($model->getFirstErrors()), []]; // todo: return more than one error
        }

        return null;
    }
}
