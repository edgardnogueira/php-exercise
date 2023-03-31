<?php

declare(strict_types=1);

namespace App\Exceptions;

use Exception;
use Throwable;

/**
 * Class DefaultException
 *
 * Generic exception handler for the application.
 */
class DefaultException extends Exception
{
    /**
     * DefaultException constructor.
     *
     * @param  string|null  $message
     * @param  int  $code
     * @param  Throwable|null  $previous
     */
    public function __construct(string $message = null, int $code = 0, Throwable $previous = null)
    {
        $message = 'DefaultException (log this info if necessary): '.$message ?? 'There was an issue.';

        parent::__construct($message, $code, $previous);
    }
}
