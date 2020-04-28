<?php
/**
 * Data Mapper for Yii2
 *
 * @link      https://github.com/hiqdev/yii2-data-mapper
 * @package   yii2-data-mapper
 * @license   BSD-3-Clause
 * @copyright Copyright (c) 2017-2018, HiQDev (http://hiqdev.com/)
 */

namespace hiqdev\yii\DataMapper\models;

use hiqdev\yii\compat\yii;
use hiqdev\yii\DataMapper\query\attributes\AbstractAttribute;
use hiqdev\yii\DataMapper\Schema\Relation;
use yii\base\InvalidConfigException;

/**
 * Class AbstractModel.
 *
 * @author Dmytro Naumenko <d.naumenko.a@gmail.com>
 */
abstract class AbstractModel implements ModelInterface
{
    public function hasAttribute(string $name): bool
    {
        return isset($this->attributes()[$name]);
    }

    public function hasRelation(string $name): bool
    {
        return isset($this->relations()[$name]);
    }

    /**
     * @param string $name
     * @throws InvalidConfigException
     * @return string
     */
    public function getRelation($name)
    {
        if (!$this->hasRelation($name)) {
            throw new InvalidConfigException('Relation "' . $name . '" is not available within ' . static::class);
        }

        $relation = $this->relations()[$name];
        if (is_string($relation)) {
            return $relation;
        }

        return $relation[Relation::TARGET];
    }

    /**
     * @param $name
     * @throws InvalidConfigException
     * @return AbstractAttribute
     */
    public function getAttribute(string $name): AbstractAttribute
    {
        if (!$this->hasAttribute($name)) {
            throw new InvalidConfigException('Attribute "' . $name . '" is not available within ' . static::class);
        }

        $className = $this->attributes()[$name];

        if (is_object($className)) {
            return $className;
        }

        return new $className();
    }
}
