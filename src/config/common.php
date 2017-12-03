<?php
/**
 * HiAPI Yii2 base project for building API
 *
 * @link      https://github.com/hiqdev/hiapi
 * @package   hiapi
 * @license   BSD-3-Clause
 * @copyright Copyright (c) 2017, HiQDev (http://hiqdev.com/)
 */

return [
    'components' => [
        'entityManager' => [
            'class' => \hiqdev\yii2\DataMapper\components\EntityManager::class,
        ],
        'db' => [
            'class'     => \hiqdev\yii2\DataMapper\components\Connection::class,
            'charset'   => 'utf8',
            'dsn'       => 'pgsql:dbname=' . $params['db.name'],
            'username'  => $params['db.user'],
            'password'  => $params['db.password'],
        ],
    ],
    'container' => [
        'definitions' => [
            \hiqdev\yii2\DataMapper\query\FieldFactoryInterface::class => \hiqdev\yii2\DataMapper\query\FieldFactory::class,
        ],
        'singletons' => [
            \hiqdev\yii2\DataMapper\components\ConnectionInterface::class => function () {
                return Yii::$app->get('db');
            },
            \hiqdev\yii2\DataMapper\components\EntityManagerInterface::class => function () {
                return Yii::$app->get('entityManager');
            },
        ],
    ],
];
