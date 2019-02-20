<?php
/**
 * Data Mapper for Yii2
 *
 * @link      https://github.com/hiqdev/yii2-data-mapper
 * @package   yii2-data-mapper
 * @license   BSD-3-Clause
 * @copyright Copyright (c) 2017-2018, HiQDev (http://hiqdev.com/)
 */

$components = [
    'entityManager' => [
        '__class' => \hiqdev\yii\DataMapper\components\EntityManager::class,
    ],
    'db' => [
        '__class'   => \hiqdev\yii\DataMapper\components\Connection::class,
        'charset'   => 'utf8',
        'dsn'       => 'pgsql:dbname=' . $params['db.name']
                        . (!empty($params['db.host']) ? (';host=' . $params['db.host']) : '')
                        . (!empty($params['db.port']) ? (';port=' . $params['db.port']) : ''),
        'username'  => $params['db.user'],
        'password'  => $params['db.password'],
        'queryBuilder' => [
            'expressionBuilders' => [
                \hiqdev\yii\DataMapper\expressions\CallExpression::class => \hiqdev\yii\DataMapper\expressions\CallExpressionBuilder::class,
                \hiqdev\yii\DataMapper\expressions\HstoreExpression::class => \hiqdev\yii\DataMapper\expressions\HstoreExpressionBuilder::class,
            ],
        ],
    ],
];

$singletons = [
    \hiqdev\yii\DataMapper\query\FieldFactoryInterface::class => \hiqdev\yii\DataMapper\query\FieldFactory::class,
    \hiqdev\yii\DataMapper\components\ConnectionInterface::class => function ($container) {
        return $container->get('db');
    },
    \hiqdev\yii\DataMapper\components\EntityManagerInterface::class => [
        '__class' => \hiqdev\yii\DataMapper\components\EntityManager::class,
        'repositories' => [
        ],
    ],

    \Zend\Hydrator\HydratorInterface::class => \hiqdev\yii\DataMapper\hydrator\ConfigurableAggregateHydrator::class,
    \hiqdev\yii\DataMapper\hydrator\ConfigurableAggregateHydrator::class => [
        'hydrators' => [
            \DateTimeImmutable::class => \hiqdev\yii\DataMapper\hydrator\DateTimeImmutableHydrator::class,
         ],
    ],
];

return class_exists('Yii')
    ? ['components' => $components, 'container' => ['singletons' => $singletons]]
    : array_merge($components, $singletons)
;
