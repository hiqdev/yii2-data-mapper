<?php
/**
 * Data Mapper for Yii2
 *
 * @link      https://github.com/hiqdev/yii2-data-mapper
 * @package   yii2-data-mapper
 * @license   BSD-3-Clause
 * @copyright Copyright (c) 2017, HiQDev (http://hiqdev.com/)
 */

namespace hiqdev\yii\DataMapper\query\attributes;

use hiqdev\yii\DataMapper\validators\AttributeValidatorFactory;

abstract class AbstractAttribute implements AttributeInterface
{
    /**
     * @var AttributeValidatorFactory
     */
    private $validatorFactory;

    public function __construct(AttributeValidatorFactory $validatorFactory) // TODO: simplify. Now it is too complex to create the object
    {
        $this->validatorFactory = $validatorFactory;
    }

    abstract protected function getOperatorRules();

    public function getRuleForOperator($operator)
    {
        $rules = $this->getOperatorRules();

        if (isset($rules[$operator])) {
            return $rules[$operator];
        }

        throw UnsupportedOperatorException::forOperator($operator);
    }

    public function getValidatorFor($operator)
    {
        $rule = $this->getRuleForOperator($operator);

        return $this->validatorFactory->createByDefinition($rule);
    }

    /**
     * @inheritdoc
     */
    public function getSupportedOperators(): array
    {
        return array_keys($this->getOperatorRules());
    }
}
