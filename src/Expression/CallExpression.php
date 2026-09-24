<?php
/**
 * Data Mapper for Yii2
 *
 * @link      https://github.com/hiqdev/yii2-data-mapper
 * @package   yii2-data-mapper
 * @license   BSD-3-Clause
 * @copyright Copyright (c) 2017-2020, HiQDev (http://hiqdev.com/)
 */

namespace hiqdev\yii\DataMapper\Expression;

use yii\db\ExpressionInterface;

/**
 * CallExpression represents a SQL function call expression.
 *
 * @author Andrii Vasyliev <sol@hiqdev.com>
 * @author Dmytro Naumenko <d.naumenko.a@gmail.com>
 */
class CallExpression implements ExpressionInterface
{
    /**
     * @var string
     */
    private $procedureName;
    /**
     * @var array array of function arguments
     */
    private $arguments;

    public function getProcedureName(): string
    {
        return $this->procedureName;
    }

    public function getArguments(): array
    {
        return $this->arguments;
    }

    /**
     * CallExpression constructor.
     *
     * @param string $procedureName
     * @param mixed $arguments array or Traversable of function arguments, or a single argument
     */
    public function __construct($procedureName, $arguments = [])
    {
        $this->procedureName = $procedureName;

        if ($arguments instanceof \Traversable) {
            $arguments = iterator_to_array($arguments, false);
        } elseif (!is_array($arguments)) {
            $arguments = [$arguments];
        }
        $this->arguments = $arguments;
    }
}
