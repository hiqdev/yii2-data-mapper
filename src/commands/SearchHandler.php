<?php

namespace hiapi\commands;

use hiapi\repositories\ActiveQuery;
use hiapi\repositories\BaseRepository;
use Yii;

class SearchHandler
{
    public function handle(SearchCommand $command)
    {
        return $this->getRepository($command)->find($this->buildQuery($command))->all();
    }

    protected function buildQuery(SearchCommand $command)
    {
        $recordClass = $this->getRepository($command)->getRecordClass();

        return new ActiveQuery($recordClass, $command->getQueryOptions());
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
