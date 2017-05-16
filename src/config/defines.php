<?php
/**
 * HiAPI Yii2 base project for building API
 *
 * @link      https://github.com/hiqdev/hiapi
 * @package   hiapi
 * @license   BSD-3-Clause
 * @copyright Copyright (c) 2017, HiQDev (http://hiqdev.com/)
 */

$_ENV['ENV'] = !empty($_ENV['ENV']) ? $_ENV['ENV'] : 'prod';
$_ENV['DEBUG'] = isset($_ENV['DEBUG']) ? $_ENV['DEBUG'] : $_ENV['ENV'] === 'dev';

defined('YII_DEBUG') or define('YII_DEBUG', $_ENV['DEBUG']);
defined('YII_ENV') or define('YII_ENV', $_ENV['ENV']);
