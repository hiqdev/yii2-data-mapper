<?php
/**
 * HiAPI Yii2 base project for building API
 *
 * @link      https://github.com/hiqdev/hiapi
 * @package   hiapi
 * @license   BSD-3-Clause
 * @copyright Copyright (c) 2017, HiQDev (http://hiqdev.com/)
 */

namespace hiapi\repositories;

use hiapi\components\ConnectionInterface;
use hiapi\query\Specification;
use Yii;

abstract class BaseRepository extends \yii\base\Component
{
    /**
     * @var ConnectionInterface
     */
    protected $db;

    protected $factory;

    /**
     * @var string
     */
    public $queryClass;

    public function find(ActiveQuery $query)
    {
        $query->setRepository($this);

        return $query;
    }

    public function setRecordClass($value)
    {
        $this->recordClass = $value;
    }

    public function getRecordClass()
    {
        if ($this->recordClass === null) {
            $this->recordClass = $this->findRecordClass();
        }

        return $this->recordClass;
    }

    public function findRecordClass()
    {
        $parts = explode('\\', get_called_class());

        return implode('\\', $parts);
    }

    public function findAll(Specification $specification)
    {
        $query = $this->buildSelectQuery($specification);
        $rows = $query->createCommand($this->db)->queryAll();
        $rows = array_map(function ($row) use ($query) {
            return $query->restoreHierarchy($row);
        }, $rows);

        return $this->createMultiple($rows);
    }

    public function findOne(Specification $specification)
    {
        $rows = $this->findAll($specification->limit(1));

        return reset($rows);
    }

    public function old_findOne(Specification $specification)
    {
        $specification->limit(1);
        $query = $this->buildSelectQuery($specification);
        $row = $query->createCommand($this->db)->queryOne();
        $row = $query->restoreHierarchy($row);

        return $this->create($row);
    }

    protected function buildSelectQuery(Specification $specification)
    {
        return $specification->applyTo($this->buildQuery()->initSelect());
    }

    protected function buildQuery()
    {
        return Yii::createObject($this->getQueryClass());
    }

    protected function getQueryClass()
    {
        return $this->queryClass;
    }

    protected function createMultiple($rows)
    {
        $entities = [];
        foreach ($rows as $row) {
            $entities[] = $this->create($row);
        }

        return $entities;
    }

    protected function create(array $row)
    {
        return $this->factory->create($this->createDto($row));
    }

    protected function createDto(array $row)
    {
        $class = $this->getEntityCreationDtoClass();
        $dto = new $class();
        $props = array_keys(get_object_vars($dto));

        foreach ($props as $name) {
            if (isset($row[$name])) {
                $dto->$name = $row[$name];
            }
        }

        return $dto;
    }

    protected function getEntityCreationDtoClass()
    {
        $class = new \ReflectionClass($this->factory);
        $method = $class->getMethod('create');
        $arg = reset($method->getParameters());

        return $arg->getClass()->getName();
    }

    public function createEntity($entityClass, $row)
    {
        return Yii::$app->entityManager->getRepository($entityClass)->create($row);
    }
}
