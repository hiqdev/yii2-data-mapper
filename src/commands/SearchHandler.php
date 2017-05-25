<?php

namespace hiapi\commands;

class SearchHandler
{
    public function handle(SearchCommand $command)
    {
        return $command->getRepository()->find($command->getQuery())->all();
    }
}
