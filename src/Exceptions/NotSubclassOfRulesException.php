<?php

declare(strict_types=1);

namespace HuubVerbeek\ModelAttributesValidation\Exceptions;

use Exception;
use HuubVerbeek\ModelAttributesValidation\ValidationRules;
use Throwable;

class NotSubclassOfRulesException extends Exception
{
    public function __construct(
        string $message = '',
        int $code = 0,
        ?Throwable $previous = null,
    ) {
        $message = $message ?: 'The provided class is not a subclass of '.ValidationRules::class;

        parent::__construct($message, $code, $previous);
    }
}
