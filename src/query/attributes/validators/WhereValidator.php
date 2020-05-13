<?php
/**
 * Data Mapper for Yii2
 *
 * @link      https://github.com/hiqdev/yii2-data-mapper
 * @package   yii2-data-mapper
 * @license   BSD-3-Clause
 * @copyright Copyright (c) 2017-2020, HiQDev (http://hiqdev.com/)
 */

namespace hiqdev\yii\DataMapper\query\attributes\validators;

use hiapi\commands\SearchCommand;
use hiqdev\yii\DataMapper\components\EntityManagerInterface;
use hiqdev\yii\DataMapper\models\ModelInterface;
use hiqdev\yii\DataMapper\query\attributes\AttributeInterface;
use yii\validators\Validator;

class WhereValidator extends Validator
{
    /**
     * @var string
     */
    public $targetEntityClass;

    private EntityManagerInterface $em;

    public function __construct(EntityManagerInterface $em, array $config = [])
    {
        $this->em = $em;

        parent::__construct($config);
    }

    /**
     * @param SearchCommand $model
     * @param string $attribute
     */
    public function validateAttribute($model, $attribute): bool
    {
        $where = $model->$attribute;

        $dataModel = $this->getDataModel();
        $dynamicModel = $this->buildDynamicModel($dataModel);
        $dynamicModel->load($where, '');
        if (!$dynamicModel->validate()) {
            $model->addErrors($dynamicModel->getErrors());

            return false;
        }
        // TODO: put back to $model->$attribute only validated data
        // $model->$attribute = $dynamicModel->toArray(); // except nulls

        return true;
    }

    private function getDataModel(): ModelInterface
    {
        return $this->em->getRepository($this->targetEntityClass)
            ->buildQuery()
            ->getModel();
    }

    private function buildDynamicModel(ModelInterface $dataModel): DynamicValidationModel
    {
        return $this->unwrapAttributes($dataModel);
    }

    private function unwrapAttributes(ModelInterface $dataModel, array $parents = []): ?DynamicValidationModel
    {
        if ($this->circularReferenceDetected($parents)) {
            return null;
        }

        $dynamicModel = new DynamicValidationModel();
        foreach ($dataModel->attributes() as $baseAttributeName => $attributeClassName) {
            /** @var AttributeInterface $attribute */
            $attribute = new $attributeClassName();
            foreach ($attribute->getSupportedOperators() as $operator) {
                $attributeName = $baseAttributeName . ($operator === '' ? '' : "_$operator");
                $dynamicModel->defineAttribute($attributeName);

                $rule = $attribute->getRuleForOperator($operator);
                $validatorName = array_shift($rule);
                $dynamicModel->addRule($attributeName, $validatorName, $rule);
            }
        }

        foreach ($dataModel->relations() as $relationName => $relationClassName) {
            $parents[] = [$relationName, $relationClassName];
            $relation = $this->unwrapAttributes(new $relationClassName(), $parents);
            if ($relation === null) {
                continue;
            }
            $dynamicModel->defineAttribute($relationName, $relation);
        }

        return $dynamicModel;
    }

    private int $relationNestingLimit = 3;

    /**
     * @psalm-param list<array{0: string, 1: class-name<ModelInterface>}> $parents
     */
    private function circularReferenceDetected(array $parents): bool
    {
        $count = 0;
        $lastRelation = array_pop($parents);
        foreach ($parents as $parent) {
            if ($parent === $lastRelation) {
                ++$count;
            }

            if ($count === $this->relationNestingLimit) {
                return true;
            }
        }

        return false;
    }
}
