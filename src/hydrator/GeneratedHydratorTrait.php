<?php
/**
 * Data Mapper for Yii2
 *
 * @link      https://github.com/hiqdev/yii2-data-mapper
 * @package   yii2-data-mapper
 * @license   BSD-3-Clause
 * @copyright Copyright (c) 2017-2018, HiQDev (http://hiqdev.com/)
 */

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

            $this->generatedHydrator = new $hydratorClass();
        }

        return $this->generatedHydrator;
    }

    public function hydrate(array $data, $object)
    {
        return $this->getGeneratedHydrator($object)->hydrate($data, $object);
    }

    /**
     * @param string $className
     * @throws \ReflectionException
     * @return object
     */
    public function createEmptyInstance(string $className, array $data = [])
    {
        $reflection = new \ReflectionClass($className);

        return $reflection->newInstanceWithoutConstructor();
    }
}
