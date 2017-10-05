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
            'class' => \hiapi\components\EntityManager::class,
        ],
        'db' => [
            'class'     => \hiapi\components\Connection::class,
            'charset'   => 'utf8',
            'dsn'       => 'pgsql:dbname=' . $params['db.name'],
            'username'  => $params['db.user'],
            'password'  => $params['db.password'],
        ],
    ],
    'container' => [
        'definitions' => [
            \hiapi\components\ConnectionInterface::class => function () {
                return Yii::$app->get('db');
            },
            \hiapi\filters\ContentNegotiator::class => [
                'class' => \yii\filters\ContentNegotiator::class,
                'formats' => [
                    'application/json' => \yii\web\Response::FORMAT_JSON,
                    // XXX disabled because browsers accept XML
//                     'application/xml'  => \yii\web\Response::FORMAT_XML,
                ],
            ],
            \hiapi\query\FieldFactoryInterface::class => \hiapi\query\FieldFactory::class,
        ],
    ],
];
