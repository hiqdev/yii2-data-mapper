<?php

namespace hiqdev\yii\DataMapper\hydrator;

use Zend\Hydrator\HydratorInterface;

trait RootHydratorAwareTrait
{
    /**
     * @var HydratorInterface
     */
    private $hydrator;

    public function __construct(HydratorInterface $hydrator)
    {
        $this->hydrator = $hydrator;
    }
}
