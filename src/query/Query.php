<?php
/**
 * Data Mapper for Yii2
 *
 * @link      https://github.com/hiqdev/yii2-data-mapper
 * @package   yii2-data-mapper
 * @license   BSD-3-Clause
 * @copyright Copyright (c) 2017, HiQDev (http://hiqdev.com/)
 */

namespace hiqdev\yii\DataMapper\query;

use hiqdev\yii\DataMapper\models\AbstractModel;
use hiqdev\yii\DataMapper\models\ModelInterface;
use hiqdev\yii\DataMapper\query\join\Join;
use yii\base\InvalidConfigException;
use yii\base\Model;

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

    public function __construct(FieldFactoryInterface $fieldFactory, array $config = [])
    {
        parent::__construct($config);

        $this->fieldFactory = $fieldFactory;

        if (!isset($this->modelClass)) {
            throw new InvalidConfigException('Property "modelClass" must be set');
        }
    }

    /**
     * @return Field[]
     */
    public function getFields()
    {
        return $this->fieldFactory->createByModelAttributes($this->getModel(), $this->attributesMap());
    }

    /**
     * @param Field[] $fields
     * @return $this
     */
    protected function selectByFields($fields)
    {
        foreach ($fields as $field) {
            if (!$field->canBeSelected()) {
                continue;
            }

            $statement = $field->getSql();
            if (is_object($statement)) {
                $this->addSelect($statement);
            } else {
                $this->addSelect($statement . ' as ' . $field->getName());
            }

            if ($field instanceof JoinedField) { // TODO: Join only if selected or filtered
                $this->registerJoin($field->getJoin());
            }
        }

        return $this;
    }

    /**
     * Registered joins array. Key - join name, value - bool true if registered
     * @var bool[]
     */
    private $_registeredJoins = [];

    public function registerJoin($name): void
    {
        if (isset($this->_registeredJoins[$name])) {
            return;
        }

        $join = $this->getJoinByName($name);

        foreach ($join->getDependencies() as $dependencyName) {
            $this->registerJoin($dependencyName);
        }

        $table = $join->getTable();
        $cond = $join->getCondition();

        if ($join instanceof LeftJoin) {
            $this->leftJoin($table, $cond);
        } else {
            $this->leftJoin($table, $cond);
        }

        $this->_registeredJoins[$name] = true;
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

    public function initSelect()
    {
        return $this
            ->initFrom()
            ->selectByFields($this->getFields());
    }

    /**
     * @var ModelInterface|AbstractModel
     */
    private $model;

    /**
     * @return ModelInterface|AbstractModel
     */
    protected function getModel(): ModelInterface
    {
        if ($this->model === null) {
            $this->model = new $this->modelClass();
        }

        return $this->model;
    }

    /**
     * // TODO: move up in hierarchy
     * @param string $name
     * @return Join
     */
    protected function getJoinByName($name): Join
    {
        $joins = $this->joins();

        if (!isset($joins[$name])) {
            throw new InvalidConfigException('Join named "' . $name . '" does not exist.');
        }

        return $joins[$name];
    }

    /**
     * @return $this
     */
    abstract protected function initFrom();

    /**
     * @return mixed
     */
    abstract protected function attributesMap();

    /**
     * @return Join[]
     */
    public function joins()
    {
        return [];
    }
}
