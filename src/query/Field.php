<?php

namespace hiapi\query;

use hiapi\query\attributes\AbstractAttribute;

class Field
{
    /**
     * @var string
     */
    protected $name;

    /**
     * @var string
     */
    protected $sql;

    /**
     * @var AbstractAttribute
     */
    protected $attribute;

    public function __construct($name, $sql, $attribute)
    {
        $this->name = $name;
        $this->sql = $sql;
        $this->attribute = $attribute;
    }

    public function canBeSelected()
    {
        return true;
    }

    public function nameEquals($value)
    {
        return strcasecmp($this->name, $value) === 0;
    }

    /**
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @return string
     */
    public function getSql()
    {
        return $this->sql;
    }

    /**
     * @return AbstractAttribute
     */
    public function getAttribute()
    {
        return $this->attribute;
    }
}
