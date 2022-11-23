<?php

namespace GarrettMassey\Analytics\Exceptions;

use Throwable;

final class ReportException extends \Exception
{
    public function __construct(
        string $message = '',
        int $code = 0,
        ?Throwable $previous = null
    ) {
        parent::__construct($message, $code, $previous);
    }

    public static function doesNotExist(string $reportName): ReportException
    {
        $message = "Report `{$reportName}` does not exist.";

        return new static($message);
    }
}
