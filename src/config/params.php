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
    'HOSTS'                 => null,

    'app.id'                => 'hisite',
    'app.name'              => 'HiSite',
    'app.language'          => null,

    'debug.enabled'         => null,
    'debug.allowedIps'      => [],
    'debug.historySize'     => 100,

    'mailer.enabled'        => YII_ENV === 'prod' ? true : null,

    'cookieValidationKey'   => null,

    'db.name'               => 'hiapi',
    'db.user'               => 'hiapi',
    'db.password'           => '*',
];
