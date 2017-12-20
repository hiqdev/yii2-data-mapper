<?php
/**
 * Data Mapper for Yii2
 *
 * @link      https://github.com/hiqdev/yii2-data-mapper
 * @package   yii2-data-mapper
 * @license   BSD-3-Clause
 * @copyright Copyright (c) 2017, HiQDev (http://hiqdev.com/)
 */

namespace hiqdev\yii\DataMapper\repositories;

use hiqdev\yii\DataMapper\components\ConnectionInterface;
use hiqdev\yii\DataMapper\components\EntityManagerInterface;
use hiqdev\yii\DataMapper\query\Specification;
use Yii;

abstract class BaseRepository extends \yii\base\Component
{
    /**
     * @var ConnectionInterface
     */
    protected $db;

    /**
     * @var EntityManagerInterface
     */
    protected $em;

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
        $rows = $this->queryAll($specification);
        $rows = $this->findAllRelations($specification, $rows);

        return $this->createMultiple($rows);
    }

    public function queryAll(Specification $specification)
    {
        $query = $this->buildSelectQuery($specification);
        $rows = $query->createCommand($this->db)->queryAll();

        return array_map(function ($row) use ($query) {
            return $query->restoreHierarchy($row);
        }, $rows);
    }

    public function findOne(Specification $specification)
    {
        $rows = $this->findAll($specification->limit(1));

        return reset($rows);
    }

    /// TODO rename
    public function findAllRelations(Specification $specification, array $rows)
    {
        //debug_print_backtrace();
        if (is_array($specification->with)) {
            foreach ($specification->with as $class) {
                /// XXX hardcoded for price
                /// TODO generalize
                $ids = $this->getIds($rows);
                if ($ids) {
                    $spec = Yii::createObject(Specification::class)
                        //->where(['in', 'plan-id', $ids]);
                        ->where(['plan-id' => reset($ids)]);
                    $rels = $this->getRepository($class)->queryAll($spec);
                    foreach ($rels as &$rel) {
                        foreach ($rows as &$row) {
                            if ($row['id'] === $rel['plan']['id']) {
                                $row['prices'][] = $rel;
                            }
                        }
                    }
                }
            }
        }

        return $rows;
    }

    protected function getIds($rows)
    {
        $ids = [];
        foreach ($rows as $row) {
            $ids[$row['id']] = $row['id'];
        }

        return $ids;
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

    /**
     * @param array $row
     * @return object
     */
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
        return $this->getRepository($entityClass)->create($row);
    }

    public function getRepository($entityClass)
    {
        return Yii::$app->entityManager->getRepository($entityClass);
    }
}
