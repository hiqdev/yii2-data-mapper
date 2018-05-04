<?php
/**
 * Data Mapper for Yii2
 *
 * @link      https://github.com/hiqdev/yii2-data-mapper
 * @package   yii2-data-mapper
 * @license   BSD-3-Clause
 * @copyright Copyright (c) 2017-2018, HiQDev (http://hiqdev.com/)
 */

namespace hiqdev\yii\DataMapper\query;

use hiqdev\yii\DataMapper\query\attributes\AbstractAttribute;

class JoinedField extends Field
{
    /**
     * @var string
     */
    protected $join;

    public function __construct($name, $sql, AbstractAttribute $attribute, $join)
    {
        parent::__construct($name, $sql, $attribute);
        $this->join = $join;
    }

    /**
     * @return string
     */
    public function getJoin()
    {
        return $this->join;
    }
}
