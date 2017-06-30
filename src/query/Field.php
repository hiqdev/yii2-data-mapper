<?php

namespace hiapi\query;

use hiapi\query\attributes\AbstractAttribute;

class Field implements FieldInterface
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

    public function __construct($name, $sql, AbstractAttribute $attribute)
    {
        $this->name = $name;
        $this->sql = $sql;
        $this->attribute = $attribute;
    }

    public function canBeSelected()
    {
        return true;
    }

    public function isApplicable($key)
    {
        return strcasecmp($this->name, $key) === 0;
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

    public function buildCondition($value)
    {

        if (is_array($value)) {
            throw new InvalidParamException('Condition ' . json_encode($value) . ' is not supported yet.');
        }

        $validator = $this->getAttribute()->getValidatorFor('eq');
        $value = $validator->normalize($value);
        $validator->validate($value);

        return [$this->getSql() => $value];
    }
}
