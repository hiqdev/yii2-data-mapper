<?php

namespace hiqdev\yii\DataMapper\repositories;

use hiqdev\yii\DataMapper\query\Specification;

interface GenericRepositoryInterface
{
    public function findAll(Specification $specification);

    /**
     * @param Specification $specification
     * @return object|false
     */
    public function findOne(Specification $specification);

    /**
     * @param Specification $specification
     * @return object
     * @throws EntityNotFoundException
     */
    public function findOneOrFail(Specification $specification);
}
