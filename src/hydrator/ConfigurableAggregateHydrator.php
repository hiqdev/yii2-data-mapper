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

use yii\di\Container;
use Zend\Hydrator\ExtractionInterface;
use Zend\Hydrator\HydrationInterface;
use Zend\Hydrator\HydratorInterface;

/**
 * Class ConfigurableAggregateHydrator.
 *
 * @author Dmytro Naumenko <d.naumenko.a@gmail.com>
 */
class ConfigurableAggregateHydrator implements HydratorInterface
{
    /**
     * @var HydrationInterface[]
     */
    public $hydrators = []; // TODO: make private after composer-config-plugin merging fix
    /**
     * @var Container
     */
    private $di;

    public function __construct(Container $di, array $hydrators = [])
    {
        $this->di = $di;
        $this->hydrators = $hydrators;
    }

    /**
     * @param string $className
     * @throws NotConfiguredException
     * @throws \yii\di\NotInstantiableException
     * @return HydrationInterface|ExtractionInterface
     */
    protected function getHydrator($className)
    {
        if (!isset($this->hydrators[$className])) {
            throw new NotConfiguredException('Hydrator for "' . $className . '" is not configured');
        }
        if (!is_object($this->hydrators[$className])) {
            $this->hydrators[$className] = $this->di->get($this->hydrators[$className]);
        }

        return $this->hydrators[$className];
    }

    /**
     * Create new object of given class with the provided $data.
     * When given $data is object just returns it.
     * @param  object|array $data
     * @param  string $class class name
     * @return object
     */
    public function create($data, $class)
    {
        return is_object($data) ? $data : $this->hydrate(is_array($data) ? $data : [$data], $class);
    }

    /**
     * Hydrate $object with the provided $data.
     *
     * @param  object|string $object object or class name
     * @return object
     */
    public function hydrate(array $data, $object)
    {
        if (is_object($object)) {
            $hydrator = $this->getHydrator(get_class($object));
        } else {
            $hydrator = $this->getHydrator($object);
            $object = $hydrator->createEmptyInstance($object, $data);
        }

        return $hydrator->hydrate($data, $object);
    }

    /**
     * Extract values from an object.
     *
     * @param  object $object
     * @return array
     */
    public function extract($object)
    {
        return $this->getHydrator(get_class($object))->extract($object);
    }

    /**
     * Extract multiple objects.
     * @return array
     */
    public function extractAll(array $array, int $depth = 1)
    {
        --$depth;
        $res = [];
        foreach ($array as $key => $object) {
            $res[$key] = $depth>0 ? $this->extractAll($object, $depth) : $this->extract($object);
        }

        return $res;
    }
}
