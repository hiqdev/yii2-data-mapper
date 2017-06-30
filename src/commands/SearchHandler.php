<?php
/**
 * HiAPI Yii2 base project for building API
 *
 * @link      https://github.com/hiqdev/hiapi
 * @package   hiapi
 * @license   BSD-3-Clause
 * @copyright Copyright (c) 2017, HiQDev (http://hiqdev.com/)
 */

namespace hiapi\commands;

use hiapi\query\Specification;
use hiapi\repositories\BaseRepository;
use Yii;

class SearchHandler
{
    public function handle(SearchCommand $command)
    {
        return $this->getRepository($command)->findAll($this->buildSpecification($command));
    }

    protected function buildSpecification(SearchCommand $command)
    {
        return Yii::createObject(Specification::class)
            ->where($command->where)
            ->limit($command->limit ?: 25);
    }

    /**
     * @param SearchCommand $command
     * @return BaseRepository
     */
    protected function getRepository(SearchCommand $command)
    {
        return Yii::$app->entityManager->getRepository($command->getEntityClass());
    }
}
