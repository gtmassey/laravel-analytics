<?php

namespace GarrettMassey\Analytics\Exceptions;

use Exception;

class InvalidPropertyIdException extends Exception
{
    const MESSAGE_INVALID_PROPERTY_ID = 'The property ID must be a non-empty string.';

    public static function invalidPropertyId(): self
    {
        return new self(message: self::MESSAGE_INVALID_PROPERTY_ID);
    }
}
