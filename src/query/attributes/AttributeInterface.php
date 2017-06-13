<?php

namespace hiapi\query\attributes;

interface AttributeInterface
{
    public function getRuleForOperator($operator);
}
