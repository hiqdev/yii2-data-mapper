<?php
/**
 * Data Mapper for Yii2
 *
 * @link      https://github.com/hiqdev/yii2-data-mapper
 * @package   yii2-data-mapper
 * @license   BSD-3-Clause
 * @copyright Copyright (c) 2017-2020, HiQDev (http://hiqdev.com/)
 */

$components = [
    'db' => [
        '__class' => \hiqdev\yii\DataMapper\Repository\Connection::class,
        'charset'   => 'utf8',
        'dsn'       => 'pgsql:dbname=' . $params['db.name']
                        . (!empty($params['db.host']) ? (';host=' . $params['db.host']) : '')
                        . (!empty($params['db.port']) ? (';port=' . $params['db.port']) : ''),
        'username'  => $params['db.user'],
        'password'  => $params['db.password'],
        'queryBuilder' => [
            'expressionBuilders' => [
                \hiqdev\yii\DataMapper\Expression\CallExpression::class => \hiqdev\yii\DataMapper\Expression\CallExpressionBuilder::class,
                \hiqdev\yii\DataMapper\Expression\HstoreExpression::class => \hiqdev\yii\DataMapper\Expression\HstoreExpressionBuilder::class,
            ],
        ],
    ],
];

$singletons = [
    \hiqdev\DataMapper\Repository\ConnectionInterface::class => function ($container) {
        return class_exists('Yii') ? \Yii::$app->get('db') : $container->get('db');
    },
];

return class_exists(Yiisoft\Factory\Definitions\Reference::class)
    ? array_merge($components, $singletons)
    : ['components' => $components, 'container' => ['singletons' => $singletons]];
