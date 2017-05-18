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
        'commandBus' => [
            'class' => \hiapi\components\CommandBus::class,
            'locator' => \hiapi\bus\InCommandLocator::class,
            'extractor' => \League\Tactician\Handler\CommandNameExtractor\ClassNameExtractor::class,
            'inflector' => \League\Tactician\Handler\MethodNameInflector\HandleInflector::class,
            'middlewares' => [
                'load' => \hiapi\bus\LoadMiddleware::class,
            ],
        ],
    ],
    'container' => [
        'definitions' => [
            \hiapi\filters\ContentNegotiator::class => [
                'class' => \yii\filters\ContentNegotiator::class,
                'formats' => [
                    'application/json' => \yii\web\Response::FORMAT_JSON,
                 // XXX disabled because browsers accept XML
                 // 'application/xml'  => \yii\web\Response::FORMAT_XML,
                ],
            ],
        ],
    ],
];
