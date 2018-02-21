<?php

namespace hiqdev\yii\DataMapper\hydrator;

use GeneratedHydrator\Configuration;
use Zend\Hydrator\HydratorInterface;

trait GeneratedHydratorTrait
{
    /**
     * @var HydratorInterface
     */
    private $generatedHydrator;

    /**
     * @param object $object
     * @return HydratorInterface
     */
    private function getGeneratedHydrator($object): HydratorInterface
    {
        if (null === $this->generatedHydrator) {
            $config = new Configuration(get_class($object));
            $hydratorClass = $config->createFactory()->getHydratorClass();

            $this->generatedHydrator = new $hydratorClass;
        }

        return $this->generatedHydrator;
    }


    public function hydrate(array $data, $object)
    {
        return $this->getGeneratedHydrator($object)->hydrate($data, $object);
    }

    /**
     * @param Object $object
     * @return object
     * @throws \ReflectionException
     */
    private function createEmptyInstance($object)
    {
        $reflection = new \ReflectionClass(get_class($object));
        return $reflection->newInstanceWithoutConstructor();
    }
}

