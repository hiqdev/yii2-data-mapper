<?php
/**
 * HiAPI Yii2 base project for building API
 *
 * @link      https://github.com/hiqdev/hiapi
 * @package   hiapi
 * @license   BSD-3-Clause
 * @copyright Copyright (c) 2017, HiQDev (http://hiqdev.com/)
 */

namespace hiapi\commands;

abstract class BaseCommand extends \yii\base\Model
{
    protected $entityClass;

    public function __construct($entityClass, $config = [])
    {
        $this->entityClass = $entityClass;

        parent::__construct($config);
    }

    public function loadFromRequest($request)
    {
        $this->load($this->getRequestData($request), '');
        $this->validate();

        return $this->hasErrors() ? $this->getErrors() : null;
    }

    public function getRequestData($request)
    {
        $get = $request->get();
        $post = $request->post();

        return array_merge($get, $post);
    }

    public function getEntityClass()
    {
        return $this->entityClass;
    }
}
