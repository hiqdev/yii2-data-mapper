<?php

namespace hiqdev\yii\DataMapper\models\relations;

use hiqdev\php\billing\EntityInterface;
use yii\base\InvalidParamException;
use yii\helpers\ArrayHelper;

class Bucket
{
    /**
     * @var array
     */
    protected $items = [];
    /**
     * @var string
     */
    private $sourceKey;

    /**
     * Bucket constructor.
     *
     * @param string $sourceKey
     */
    public function __construct($sourceKey)
    {
        $this->sourceKey = $sourceKey;
    }

    /**
     * @param $rows
     * @param $sourceKey
     * @return static
     */
    public static function fromRows($rows, $sourceKey)
    {
        $bucket = new static($sourceKey);
        $bucket->initialize($rows);

        return $bucket;
    }

    protected function initialize($rows)
    {
        $result = [];
        foreach ($rows as $row) {
            $key = $row[$this->sourceKey];
            $result[$key] = [];
        }
        $this->items = $result;

        return $this;
    }

    public function getKeys()
    {
        return array_keys($this->items);
    }

    /**
     * @param EntityInterface[] $entities
     * @param string $key the attribute name in $entity that represent this relation
     * @param string $entityKey
     * @return $this
     */
    public function fill($entities, $key, $entityIdKey)
    {
        foreach ($entities as $entity) {
            $itemKey = ArrayHelper::getValue($entity, $key);
            if (!isset($this->items[$itemKey])) {
                throw new InvalidParamException('This should not happen. Result was not requested in bucket.');
            }
            $entityKey = ArrayHelper::getValue($entity, $entityIdKey);
            $this->items[$itemKey][$entityKey] = $entity;
        }

        return $this;
    }

    public function pour(&$rows, $relationName)
    {
        foreach ($rows as &$row) {
            $keyName = $this->sourceKey;
            $key = $row[$keyName];
            $row[$relationName] = $this->items[$key];
        }

        return $this;
    }
}
