<?php

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
        return (new Specification())
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
