<?php

namespace hiapi\query;

abstract class Query extends \yii\db\Query
{
    /**
     * @var FieldFactoryInterface
     */
    protected $fieldFactory;

    /**
     * @var string
     */
    protected $modelClass;

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
        return $this->fieldFactory->createByModelAttributes(new $this->modelClass, $this->attributesMap());
    }

    /**
     * @param Field[] $fields
     * @return $this
     */
    protected function selectByFields($fields)
    {
        foreach ($fields as $field) {
            if ($field->canBeSelected()) {
                $this->addSelect($field->getSql() . ' as ' . $field->getName());
            }
        }

        return $this;
    }

    public function restoreHierarchy($row)
    {
        foreach ($row as $key => $value) {
            $parts = explode($this->fieldFactory->getHierarchySeparator(), $key, 2);
            if (count($parts) > 1) {
                $row[$parts[0]][$parts[1]] = $value;
                unset($row[$key]);
            }
        }

        return $row;
    }

    /**
     * @return mixed
     */
    abstract protected function attributesMap();
}
