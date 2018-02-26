<?php

namespace hiqdev\yii\DataMapper\repositories;

use Throwable;

/**
 * Class EntityNotFoundException
 *
 * @author Dmytro Naumenko <d.naumenko.a@gmail.com>
 */
class EntityNotFoundException extends \RuntimeException
{
    public function __construct(string $message = "", int $code = 0, Throwable $previous = null)
    {
        parent::__construct($message ?: 'Entity was not found', $code, $previous);
    }
}
