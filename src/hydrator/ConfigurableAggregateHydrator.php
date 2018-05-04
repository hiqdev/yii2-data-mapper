<?php

namespace hiqdev\yii\DataMapper\hydrator;

use yii\base\InvalidConfigException;
use yii\di\Container;
use Zend\Hydrator\ExtractionInterface;
use Zend\Hydrator\HydrationInterface;
use Zend\Hydrator\HydratorInterface;

/**
 * Class ConfigurableAggregateHydrator
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
     * @return HydrationInterface|ExtractionInterface
     * @throws InvalidConfigException
     * @throws \yii\di\NotInstantiableException
     */
    protected function getHydrator($className)
    {
        if (!isset($this->hydrators[$className])) {
            throw new InvalidConfigException('Hydrator for "' . $className . '" is not configured'); // todo: more specific exception
        }
        if (!is_object($this->hydrators[$className])) {
            $this->hydrators[$className] = $this->di->get($this->hydrators[$className]);
        }

        return $this->hydrators[$className];
    }

    /**
     * Hydrate $object with the provided $data.
     *
     * @param  array $data
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
     * Extract values from an object
     *
     * @param  object $object
     * @return array
     */
    public function extract($object)
    {
        return $this->getHydrator(get_class($object))->extract($object);
    }
}
