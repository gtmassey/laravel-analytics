<?php

namespace Gtmassey\LaravelAnalytics\Exceptions;

use Exception;
use Throwable;

class InvalidCredentialsFileException extends Exception
{
    const MESSAGE_INVALID_PATH = 'The credentials file path must be a non-empty string.';

    const MESSAGE_NOT_FOUND = 'The credentials file does not exist.';

    const MESSAGE_INVALID_JSON = 'The credentials file is not a valid JSON file.';

    public static function invalidPath(): self
    {
        return new self(message: self::MESSAGE_INVALID_PATH);
    }

    public static function notFound(?Throwable $previous = null): self
    {
        return new self(message: self::MESSAGE_NOT_FOUND, previous: $previous);
    }

    public static function invalidJson(): self
    {
        return new self(message: self::MESSAGE_INVALID_JSON);
    }
}
