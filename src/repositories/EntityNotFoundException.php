<?php
/**
 * Data Mapper for Yii2
 *
 * @link      https://github.com/hiqdev/yii2-data-mapper
 * @package   yii2-data-mapper
 * @license   BSD-3-Clause
 * @copyright Copyright (c) 2017-2018, HiQDev (http://hiqdev.com/)
 */

namespace hiqdev\yii\DataMapper\repositories;

use Throwable;

/**
 * Class EntityNotFoundException.
 *
 * @author Dmytro Naumenko <d.naumenko.a@gmail.com>
 */
class EntityNotFoundException extends \RuntimeException
{
    public function __construct(string $message = '', int $code = 0, Throwable $previous = null)
    {
        parent::__construct($message ?: 'Entity was not found', $code, $previous);
    }
}
