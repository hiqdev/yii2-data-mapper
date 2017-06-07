<?php

namespace hiapi\query;

class Query extends \yii\db\Query
{
    /**
     * @var FieldFactoryInterface
     */
    protected $fieldFactory;

    public function __construct(FieldFactoryInterface $filterFactory, array $config = [])
    {
        parent::__construct($config);

        $this->fieldFactory = $filterFactory;
    }

    /**
     * @return Field[]
     */
    public function getFields()
    {
        return [];
    }
}
