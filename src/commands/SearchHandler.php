<?php

namespace hiapi\commands;

use hiapi\repositories\ActiveQuery;

class SearchHandler
{
    public function handle(SearchCommand $command)
    {
        return $command->getRepository()->find($this->getQuery($command))->all();
    }

    public function getQuery(SearchCommand $command)
    {
        return new ActiveQuery($command->getRecordClass(), $command->getQueryOptions());
    }
}
