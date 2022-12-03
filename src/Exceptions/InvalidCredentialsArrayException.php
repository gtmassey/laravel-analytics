<?php

namespace Gtmassey\LaravelAnalytics\Exceptions;

use Exception;

class InvalidCredentialsArrayException extends Exception
{
    const MESSAGE_INVALID_ARRAY = 'The credentials array must be a non-empty array.';

    public static function invalidArray(): self
    {
        return new self(message: self::MESSAGE_INVALID_ARRAY);
    }
}
