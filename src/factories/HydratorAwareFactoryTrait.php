<?php

namespace hiqdev\yii\DataMapper\factories;

trait HydratorAwareFactoryTrait
{
    /**
     * @param array $data
     * @return object
     */
    public function hydrate(array $data)
    {
        $instance = $this->createEmptyInstance();
        $this->hydrator->hydrate($data, $instance);

        return $instance;
    }

    /**
     * @return object
     * @throws \ReflectionException
     */
    private function createEmptyInstance()
    {
        $reflection = new \ReflectionClass($this->getEntityClassName());
        return $reflection->newInstanceWithoutConstructor();
    }
}

