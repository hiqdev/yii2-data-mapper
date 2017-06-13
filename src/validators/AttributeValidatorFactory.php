<?php

namespace hiapi\validators;

use hiapi\query\Field;
use Yii;
use yii\base\InvalidConfigException;
use yii\validators\InlineValidator;
use yii\validators\Validator;

class AttributeValidatorFactory
{
    /**
     * @var array
     */
    protected $aliases = [

    ];

    function __construct($aliases = null)
    {
        if (is_array($aliases)) {
            $this->aliases = $aliases;
        }
    }

    /**
     * @param Field $field
     * @return AttributeValidator
     */
    public function createFor(Field $field, $operator)
    {
        $rule = $field->getAttribute()->getRuleForOperator($operator);

        return $this->createByDefinition($rule);
    }

    public function createByDefinition($definition)
    {
        if (is_string($definition)) {
            return $this->createByType($definition);
        }

        return $this->createByType($definition[0], array_slice($definition, 1));
    }

    /**
     * @param string $type
     * @param array $params
     * @return AttributeValidator
     */
    public function createByType($type, $params = [])
    {
        if ($type instanceof \Closure) {
            // method-based validator
            $params['class'] = InlineValidator::class;
            $params['method'] = $type;
        } else {
            if (isset(Validator::$builtInValidators[$type])) {
                $type = Validator::$builtInValidators[$type];
            } elseif (isset($this->aliases[$type])) {
                $type = $this->aliases[$type];
            }

            if (is_array($type)) {
                $params = array_merge($type, $params);
            } else {
                $params['class'] = $type;
            }
        }

        $validator = Yii::createObject($params);

        return new AttributeValidator($validator);
    }
}
