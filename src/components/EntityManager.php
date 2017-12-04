<?php
/**
 * Data Mapper for Yii2
 *
 * @link      https://github.com/hiqdev/yii2-data-mapper
 * @package   yii2-data-mapper
 * @license   BSD-3-Clause
 * @copyright Copyright (c) 2017, HiQDev (http://hiqdev.com/)
 */

namespace hiqdev\yii\DataMapper\components;

use Yii;

class EntityManager extends \yii\base\Component implements EntityManagerInterface
{
    /**
     * @var array
     */
    public $repositories = [];

    /**
     * @var ConnectionInterface
     */
    public $db;

    public function __construct(
        ConnectionInterface $db,
        array $config = []
    ) {
        $this->db = $db;

        parent::__construct($config);
    }

    /**
     * Get database connection.
     * @return ConnectionInterface
     */
    public function getConnection()
    {
        return $this->db;
    }

    /**
     * Get entity repository by entity or class.
     * @param object|string $entityClass entity or class
     * @return RepositoryInterface
     */
    public function getRepository($entityClass)
    {
        if (is_object($entityClass)) {
            $entityClass = get_class($entityClass);
        }

        if (!isset($this->repositories[$entityClass])) {
            throw new \Exception("no repository defined for: $entityClass");
        }

        if (!is_object($this->repositories[$entityClass])) {
            $this->repositories[$entityClass] = Yii::createObject($this->repositories[$entityClass]);
        }

        return $this->repositories[$entityClass];
    }

    /**
     * Save given entity into it's repository.
     * @param object $entity
     */
    public function save($entity)
    {
        $repo = $this->getRepository($entity);
        $repo->save($entity);
    }

    /**
     * Create entity of given class with given data.
     * @param string $entityClass
     * @param array $data
     * @return object
     */
    public function create($entityClass, array $data)
    {
        return $this->getRepository($entityClass)->create($data);
    }

    /**
     * XXX TODO think of the whole process:
     * alternative: find and populate whole entity.
     * @param object $entity
     * @return string|int
     */
    public function findId($entity)
    {
        return $this->getRepository($entity)->findId($entity);
    }
}
