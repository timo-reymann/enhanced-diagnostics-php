<?php

namespace TimoReymann\EnhancedDiagnostics\Exception;


use Throwable;

/**
 * Error decrypting report
 * @package TimoReymann\EnhancedDiagnostics\Exception
 */
class DecryptException extends \Exception
{
    public function __construct($message = "", $code = 0, Throwable $previous = null)
    {
        parent::__construct($message, $code, $previous);
    }
}