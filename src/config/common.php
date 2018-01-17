<?php
/**
 * Data Mapper for Yii2
 *
 * @link      https://github.com/hiqdev/yii2-data-mapper
 * @package   yii2-data-mapper
 * @license   BSD-3-Clause
 * @copyright Copyright (c) 2017, HiQDev (http://hiqdev.com/)
 */

return [
    'components' => [
        'entityManager' => [
            'class' => \hiqdev\yii\DataMapper\components\EntityManager::class,
        ],
        'db' => [
            'class'     => \hiqdev\yii\DataMapper\components\Connection::class,
            'charset'   => 'utf8',
            'dsn'       => 'pgsql:dbname=' . $params['db.name']
                            . (!empty($params['db.host']) ? (';host=' . $params['db.host']) : '')
                            . (!empty($params['db.port']) ? (';port=' . $params['db.port']) : ''),
            'username'  => $params['db.user'],
            'password'  => $params['db.password'],
        ],
    ],
    'container' => [
        'definitions' => [
            \hiqdev\yii\DataMapper\query\FieldFactoryInterface::class => \hiqdev\yii\DataMapper\query\FieldFactory::class,
        ],
        'singletons' => [
            \hiqdev\yii\DataMapper\components\ConnectionInterface::class => function () {
                return Yii::$app->get('db');
            },
            \hiqdev\yii\DataMapper\components\EntityManagerInterface::class => function () {
                return Yii::$app->get('entityManager');
            },
        ],
    ],
];
