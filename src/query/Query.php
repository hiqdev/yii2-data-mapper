<?php

namespace hiapi\query;

use yii\base\InvalidConfigException;

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

        if (!isset($this->modelClass)) {
            throw new InvalidConfigException('Property "modelClass" must be set');
        }
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
        $separator = $this->fieldFactory->getHierarchySeparator();

        foreach ($row as $key => $value) {
            if (strpos($key, $separator) === false) {
                continue;
            }

            $parts = explode($separator, $key);
            while (!empty($parts)) {
                $value = [array_pop($parts) => $value];
            }
            $row = array_merge_recursive($row, $value);
        }

        return $row;
    }

    /**
     * @return mixed
     */
    abstract protected function attributesMap();
}
