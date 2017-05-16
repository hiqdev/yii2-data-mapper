<?php
/**
 * HiSite Yii2 base project.
 *
 * @link      https://github.com/hiqdev/hisite
 * @package   hisite
 * @license   BSD-3-Clause
 * @copyright Copyright (c) 2016-2017, HiQDev (http://hiqdev.com/)
 */

return [
    'app.id'                => 'hisite',
    'app.name'              => 'HiSite',
    'app.language'          => null,

    'debug.enabled'         => null,
    'debug.allowedIps'      => [],
    'debug.historySize'     => 100,

    'mailer.enabled'        => YII_ENV === 'prod' ? true : null,

    'cookieValidationKey'   => null,
];
