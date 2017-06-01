<?php

namespace hiapi\query;

use yii\db\QueryTrait;

class Specification
{
    use QueryTrait;

    public $requestedRelations = [];

    public function requestRelation($name)
    {
        $this->requestedRelations[$name] = true; // todo: specification for relation
    }
}
