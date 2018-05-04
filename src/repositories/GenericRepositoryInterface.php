<?php
/**
 * Data Mapper for Yii2
 *
 * @link      https://github.com/hiqdev/yii2-data-mapper
 * @package   yii2-data-mapper
 * @license   BSD-3-Clause
 * @copyright Copyright (c) 2017-2018, HiQDev (http://hiqdev.com/)
 */

namespace hiqdev\yii\DataMapper\repositories;

use hiqdev\yii\DataMapper\query\Specification;

/**
 * Interface GenericRepositoryInterface.
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
     * @throws EntityNotFoundException
     * @return object
     */
    public function findOneOrFail(Specification $specification);
}
