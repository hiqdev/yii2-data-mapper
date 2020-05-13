<?php
/**
 * Data Mapper for Yii2
 *
 * @link      https://github.com/hiqdev/yii2-data-mapper
 * @package   yii2-data-mapper
 * @license   BSD-3-Clause
 * @copyright Copyright (c) 2017-2020, HiQDev (http://hiqdev.com/)
 */

namespace hiqdev\yii\DataMapper\hydrator;

use GeneratedHydrator\Configuration;
use Zend\Hydrator\HydratorInterface;

trait GeneratedHydratorTrait
{
    /**
     * @var HydratorInterface[]
     */
    protected $generatedHydrators = [];

    /**
     * @param object $object
     */
    protected function getGeneratedHydrator($object): HydratorInterface
    {
        $class = get_class($object);
        if (empty($this->generatedHydrators[$class])) {
            $config = new Configuration($class);
            $hydratorClass = $config->createFactory()->getHydratorClass();

            $this->generatedHydrators[$class] = new $hydratorClass();
        }

        return $this->generatedHydrators[$class];
    }

    public function hydrate(array $data, $object)
    {
        return $this->getGeneratedHydrator($object)->hydrate($data, $object);
    }

    /**
     * @throws \ReflectionException
     * @return object
     */
    public function createEmptyInstance(string $className, array $data = [])
    {
        $reflection = new \ReflectionClass($className);

        return $reflection->newInstanceWithoutConstructor();
    }
}
