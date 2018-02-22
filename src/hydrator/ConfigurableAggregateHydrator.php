<?php

namespace hiqdev\yii\DataMapper\hydrator;

use yii\base\InvalidConfigException;
use yii\di\Container;
use Zend\Hydrator\ExtractionInterface;
use Zend\Hydrator\HydrationInterface;
use Zend\Hydrator\HydratorInterface;

class ConfigurableAggregateHydrator implements HydratorInterface
{
    /**
     * @var HydrationInterface[]
     */
    private $hydrators = [];
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
     * @param $object
     * @return HydrationInterface|ExtractionInterface
     * @throws InvalidConfigException
     * @throws \yii\di\NotInstantiableException
     */
    protected function getHydrator($object)
    {
        $className = get_class($object);

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
     * @param  object $object
     * @return object
     */
    public function hydrate(array $data, $object)
    {
        return $this->getHydrator($object)->hydrate($data, $object);
    }

    /**
     * Extract values from an object
     *
     * @param  object $object
     * @return array
     */
    public function extract($object)
    {
        return $this->getHydrator($object)->extract($object);
    }
}
