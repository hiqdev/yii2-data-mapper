<?php

namespace hiapi\query\types;

interface AttributeInterface
{
    public function getOperatorRules();

    public function getRuleForOperator($operator);
}
