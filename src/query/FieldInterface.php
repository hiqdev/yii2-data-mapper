<?php

namespace hiapi\query;

use hiapi\query\attributes\AbstractAttribute;

interface FieldInterface
{
    public function canBeSelected();

    public function isApplicable($key);

    /**
     * @return array
     */
    public function buildCondition($value);
}
