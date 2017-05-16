<?php
/**
 * HiAPI - template for Yii2 based API
 *
 * @link      https://github.com/hiqdev/hiapi-core
 * @package   hiapi-core
 * @license   BSD-3-Clause
 * @copyright Copyright (c) 2017, HiQDev (http://hiqdev.com/)
 */

return array_filter([
    'id' => 'hiapi',
    'name' => 'HiAPI',
    'aliases' => [
        '@bower' => '@vendor/bower-asset',
        '@npm' => '@vendor/npm-asset',
        '@vendor/bower' => '@vendor/bower-asset',
        '@vendor/npm' => '@vendor/npm-asset',
    ],
    'basePath' => dirname(__DIR__),
    'viewPath' => '@hiapi/views',
    'vendorPath' => '@root/vendor',
    'runtimePath' => '@root/runtime',
    'controllerNamespace' => 'hiapi\controllers',
    'bootstrap' => array_filter([
        'log' => 'log',
        'debug' => empty($params['debug.enabled']) ? null : 'debug',
    ]),
    'catchAll' => ['hiapi/catch'],
    'components' => [
        'request' => [
            'enableCsrfCookie' => false,
        ],
        'mailer' => [
            'viewPath' => '@hiapi/views/mail',
            'htmlLayout' => '@hiapi/views/layouts/mail-html',
            'textLayout' => '@hiapi/views/layouts/mail-text',
        ],
        'log' => [
            'traceLevel' => defined('YII_DEBUG') && YII_DEBUG ? 3 : 0,
            'targets' => [
                'default' => [
                    'class' => \yii\log\FileTarget::class,
                    'levels' => ['error', 'warning'],
                ],
            ],
        ],
        'urlManager' => [
            'class' => \yii\web\UrlManager::class,
        ],
    ],
    'modules' => array_filter([
        'debug' => empty($params['debug.enabled']) ? null : array_filter([
            'class' => \yii\debug\Module::class,
            'allowedIPs' => isset($params['debug.allowedIps']) ? $params['debug.allowedIps'] : null,
            'historySize' => isset($params['debug.historySize']) ? $params['debug.historySize'] : null,
        ]),
    ]),
    'container' => [
        'singletons' => [
            \yii\base\Application::class => function () {
                return Yii::$app;
            },
            \yii\mail\MailerInterface::class => function () {
                return Yii::$app->get('mailer');
            },
        ],
    ],
]);
