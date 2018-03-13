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
use hiqdev\yii\DataMapper\query\Query;
use hiqdev\yii\DataMapper\query\Specification;
use Yii;
use yii\db\Connection;
use Zend\Hydrator\HydratorInterface;

abstract class BaseRepository extends \yii\base\Component implements GenericRepositoryInterface
{
    /**
     * @var ConnectionInterface|Connection
     */
    protected $db;

    /**
     * @var EntityManagerInterface
     */
    protected $em;

    /**
     * @var HydratorInterface
     */
    protected $factory;

    /**
     * @var string
     */
    public $queryClass;

    public function __construct(ConnectionInterface $db, EntityManagerInterface $em, array $config = [])
    {
        $this->db = $db;
        $this->em = $em;

        parent::__construct($config);
    }

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

    /**
     * @param Specification $specification
     * @return object[]
     */
    public function findAll(Specification $specification)
    {
        $rows = $this->queryAll($specification);

        return $this->hydrateMultipleNew($rows);
    }

    public function queryAll(Specification $specification)
    {
        $query = $this->buildSelectQuery($specification);
        $rows = $query->createCommand($this->db)->queryAll();
        $rows = array_map(function ($row) use ($query) {
            return $query->restoreHierarchy($row);
        }, $rows);

        return $this->findAllRelations($specification, $rows);
    }

    /**
     * @param Specification $specification
     * @return object|false
     */
    public function findOne(Specification $specification)
    {
        $rows = $this->findAll($specification->limit(1));

        return reset($rows);
    }

    /**
     * @param Specification $specification
     * @return false|object
     * @throws EntityNotFoundException when entity was not found
     */
    public function findOneOrFail(Specification $specification)
    {
        $result = $this->findOne($specification);
        if ($result === false) {
            throw new EntityNotFoundException();
        }

        return $result;
    }

    /// TODO rename
    public function findAllRelations(Specification $specification, array $rows)
    {
        if (!is_array($specification->with)) {
            return $rows;
        }

        foreach ($specification->with as $relationName) {
            $this->joinRelation($relationName, $rows);
        }

        return $rows;
    }
    
    protected function joinRelation($relationName, &$rows)
    {
        call_user_func_array([$this, 'join' . $relationName], [&$rows]);
    }

    public function old_findOne(Specification $specification)
    {
        $specification->limit(1);
        $query = $this->buildSelectQuery($specification);
        $row = $query->createCommand($this->db)->queryOne();
        $row = $query->restoreHierarchy($row);

        return $this->hydrateNew($row);
    }

    protected function buildSelectQuery(Specification $specification)
    {
        return $specification->applyTo($this->buildQuery()->initSelect());
    }

    /**
     * @return Query
     */
    protected function buildQuery(): Query
    {
        return Yii::createObject($this->getQueryClass());
    }

    protected function getQueryClass()
    {
        return $this->queryClass;
    }

    protected function hydrateMultipleNew($rows)
    {
        $entities = [];
        foreach ($rows as $row) {
            $entities[] = $this->hydrateNew($row);
        }

        return $entities;
    }

    /**
     * @param array $row
     * @return object
     */
    public function hydrateNew(array $row)
    {
        return $this->factory->hydrateNewObject($row);
    }

    protected function getEntityCreationDtoClass()
    {
        $class = new \ReflectionClass($this->factory);
        $method = $class->getMethod('hydrate');
        $arg = reset($method->getParameters());

        return $arg->getClass()->getName();
    }

    /**
     * @param $entityClass
     * @return BaseRepository
     */
    public function getRepository($entityClass)
    {
        return $this->em->getRepository($entityClass);
    }

}
