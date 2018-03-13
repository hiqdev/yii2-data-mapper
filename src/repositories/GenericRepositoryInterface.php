<?php

namespace hiqdev\yii\DataMapper\repositories;

use hiqdev\yii\DataMapper\query\Specification;

/**
 * Interface GenericRepositoryInterface
 *
 * @author Dmytro Naumenko <d.naumenko.a@gmail.com>
 */
interface GenericRepositoryInterface
{
    /**
     * @param Specification $specification
     * @return object[]
     */
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
