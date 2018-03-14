<?php

namespace hiqdev\yii\DataMapper\factories;

trait HydratorAwareFactoryTrait
{
    /**
     * @param array $data
     * @return object
     */
    public function hydrateNewObject(array $data)
    {
        return $this->hydrate($data, $this->createEmptyInstance());
    }

    /**
     * @param array $data
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
     * @return object
     * @throws \ReflectionException
     */
    private function createEmptyInstance(?string $className = null)
    {
        $className = $className ?? $this->getEntityClassName();

        $reflection = new \ReflectionClass($className);
        return $reflection->newInstanceWithoutConstructor();
    }
}

