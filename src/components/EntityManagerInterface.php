<?php
/**
 * Data Mapper for Yii2
 *
 * @link      https://github.com/hiqdev/yii2-data-mapper
 * @package   yii2-data-mapper
 * @license   BSD-3-Clause
 * @copyright Copyright (c) 2017-2018, HiQDev (http://hiqdev.com/)
 */

namespace hiqdev\yii\DataMapper\components;

use hiqdev\yii\DataMapper\repositories\BaseRepository;

interface EntityManagerInterface
{
    /**
     * @param string $entityClass
     * @return BaseRepository
     */
    public function getRepository($entityClass);

    public function save($entity);

    /**
     * @param array $data
     * @param object|string $object entity or class name
     * @return object
     */
    public function hydrate(array $data, $object);
}
