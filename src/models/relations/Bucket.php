<?php
/**
 * Data Mapper for Yii2
 *
 * @link      https://github.com/hiqdev/yii2-data-mapper
 * @package   yii2-data-mapper
 * @license   BSD-3-Clause
 * @copyright Copyright (c) 2017-2018, HiQDev (http://hiqdev.com/)
 */

namespace hiqdev\yii\DataMapper\models\relations;

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
            if ($key === null) {
                continue;
            }
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
     * Fills current bucket with $entities.
     * Each entity will be placed in bucket as follows:.
     *
     *
     *
     * @param array $entities
     * @param string $key the attribute name in $entity that represents this relation with [[items]]
     * @param string|null $entityIdKey the attribute name that is a primary key of the $entity and will be used for one-to-many relation
     * Optional. In case `null`, identifiers will be sequential.
     * @return $this
     */
    public function fill($entities, $key, $entityIdKey = null)
    {
        foreach ($entities as $entity) {
            $itemKey = ArrayHelper::getValue($entity, $key);
            if (!isset($this->items[$itemKey])) {
                throw new \RuntimeException('This should not happen. Result was not requested in bucket.');
            }

            if ($entityIdKey !== null) {
                $entityKey = ArrayHelper::getValue($entity, $entityIdKey);
                $this->items[$itemKey][$entityKey] = $entity;
            } else {
                $this->items[$itemKey][] = $entity;
            }
        }

        return $this;
    }

    public function pour(&$rows, $relationName)
    {
        foreach ($rows as &$row) {
            $keyName = $this->sourceKey;
            $key = $row[$keyName];
            if (!isset($this->items[$key])) {
                $row[$relationName] = null;
            } else {
                $row[$relationName] = $this->items[$key];
            }
        }

        return $this;
    }

    public function pourOneToOne(&$rows, $relationName)
    {
        foreach ($rows as &$row) {
            $keyName = $this->sourceKey;
            $key = $row[$keyName];
            if (!isset($this->items[$key])) {
                $row[$relationName] = null;
            } else {
                $row[$relationName] = reset($this->items[$key]);
            }
        }

        return $this;
    }
}
