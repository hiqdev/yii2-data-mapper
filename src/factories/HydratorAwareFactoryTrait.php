<?php
/**
 * Data Mapper for Yii2
 *
 * @link      https://github.com/hiqdev/yii2-data-mapper
 * @package   yii2-data-mapper
 * @license   BSD-3-Clause
 * @copyright Copyright (c) 2017-2020, HiQDev (http://hiqdev.com/)
 */

namespace hiqdev\yii\DataMapper\factories;

/**
 * Trait HydratorAwareFactoryTrait.
 *
 * @author Dmytro Naumenko <d.naumenko.a@gmail.com>
 */
trait HydratorAwareFactoryTrait
{
    /**
     * @return object
     */
    public function hydrateNewObject(array $data)
    {
        return $this->hydrate($data, $this->createEmptyInstance());
    }

    /**
     * @param object $object
     * @return object
     */
    public function hydrate(array $data, $object)
    {
        $this->hydrator->hydrate($data, $object);

        return $object;
    }

    /**
     * @param string $className
     * @throws \ReflectionException
     * @return object
     */
    private function createEmptyInstance(?string $className = null)
    {
        $className = $className ?? $this->getEntityClassName();

        $reflection = new \ReflectionClass($className);

        return $reflection->newInstanceWithoutConstructor();
    }
}
