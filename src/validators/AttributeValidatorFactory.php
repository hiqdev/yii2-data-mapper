<?php
/**
 * Data Mapper for Yii2
 *
 * @link      https://github.com/hiqdev/yii2-data-mapper
 * @package   yii2-data-mapper
 * @license   BSD-3-Clause
 * @copyright Copyright (c) 2017-2018, HiQDev (http://hiqdev.com/)
 */

namespace hiqdev\yii\DataMapper\validators;

use yii\validators\InlineValidator;
use yii\validators\Validator;

class AttributeValidatorFactory
{
    /**
     * @var array
     */
    protected $aliases = [
    ];

    public function __construct($aliases = null)
    {
        if (is_array($aliases)) {
            $this->aliases = $aliases;
        }
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

        $validator = $this->createObject($params);

        return new AttributeValidator($validator);
    }

    protected function createObject($config)
    {
        return class_exists('Yii') ? \Yii::createObject($config) : \yii\helpers\Yii::createObject($config);
    }
}
