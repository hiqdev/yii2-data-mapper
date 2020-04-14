<?php

namespace hiqdev\yii\DataMapper\validators;

use hiqdev\yii\DataMapper\models\ModelInterface;
use hiqdev\yii\DataMapper\query\attributes\AttributeInterface;
use yii\base\DynamicModel;
use yii\validators\Validator;

class WhereValidator extends Validator
{
    /**
     * @var array<string, class-string<AttributeInterface>>
     * @psalm-readonly
     */
    public $filters = [];

    /**
     * @var array<string, class-string<ModelInterface>>
     * @psalm-readonly
     */
    public $relations = [];

    /**
     * @var AttributeValidatorFactory
     */
    private $attributeValidatorFactory;

    public function __construct(AttributeValidatorFactory $attributeValidatorFactory, array $config = [])
    {
        parent::__construct($config);

        $this->attributeValidatorFactory = $attributeValidatorFactory;
    }

    public function validateAttribute($model, $attribute): bool
    {
        $where = $model->$attribute;
        
        $dynamicModel = $this->buildDynamicModel();
        $dynamicModel->load($where, '');
        if (!$dynamicModel->validate()) {
            $model->addErrors($dynamicModel->getErrors());

            return false;
        }

        return true;
    }

    /**
     * @return DynamicModel
     */
    private function buildDynamicModel(): DynamicModel
    {
        $attributeRules = $this->unwrapAttributes();

        $dynamicModel = new DynamicModel(array_keys($attributeRules));
        foreach ($attributeRules as $attribute => $rule) {
            $validatorName = array_shift($rule);
            $dynamicModel->addRule($attribute, $validatorName, $rule);
        }

        return $dynamicModel;
    }

    private function unwrapAttributes(): array
    {
        $result = [];

        foreach ($this->filters as $baseAttributeName => $attributeClassName) {
            /** @var AttributeInterface $attribute */
            $attribute = new $attributeClassName($this->attributeValidatorFactory);
            foreach ($attribute->getSupportedOperators() as $operator) {
                $attributeName = $baseAttributeName . ($operator === '' ? '' : "_$operator");
                $result[$attributeName] = $attribute->getRuleForOperator($operator);
            }
        }

        foreach ($this->relations as $relationName => $relationClassName) {
            /** @var AttributeInterface $attribute */
        }

        return $result;
    }
}
