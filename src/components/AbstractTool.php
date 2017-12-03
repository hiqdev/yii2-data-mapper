<?php
/**
 * Data Mapper for Yii2
 *
 * @link      https://github.com/hiqdev/yii2-data-mapper
 * @package   yii2-data-mapper
 * @license   BSD-3-Clause
 * @copyright Copyright (c) 2017, HiQDev (http://hiqdev.com/)
 */

namespace hiapi\components;

use g;
use Yii;

abstract class AbstractTool extends \yii\base\Component
{
    protected $base;

    /**
     * @var array tool configuration
     */
    protected $data;

    public function __construct($base, $data)
    {
        $this->base = $base;
        $this->data = $data;

        /// XXX WTF? $base->di becomes null after passing as argument
        /// TODO fix!
        if ($this->base->di === null) {
            $this->base->di = Yii::$container;
        }
        if ($this->base->dbc === null) {
            $this->base->dbc = g::dbc();
        }
    }

    public function getBase()
    {
        return $this->base;
    }

    public function getDi()
    {
        return $this->base->di;
    }

    public function getDbc()
    {
        return $this->base->dbc;
    }
}
