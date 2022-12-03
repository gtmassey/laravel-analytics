<?php

namespace Gtmassey\LaravelAnalytics\Exceptions;

use Exception;

class InvalidCredentialsJsonStringException extends Exception
{
    const MESSAGE_INVALID_STRING = 'The credentials JSON string must be a non-empty string.';

    const MESSAGE_INVALID_JSON = 'The credentials JSON string is not a valid JSON string.';

    public static function invalidString(): self
    {
        return new self(message: self::MESSAGE_INVALID_STRING);
    }

    public static function invalidJson(): self
    {
        return new self(message: self::MESSAGE_INVALID_JSON);
    }
}
