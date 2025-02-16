<?php

namespace Abelapko\Interpreter\Exceptions;

use Exception;

class AstExecutionException extends Exception
{
    public function __construct(string $message, ?string $nodeType = null)
    {
        $formattedMessage = "AST Execution Error: " . ($nodeType ? "[$nodeType] " : "") . $message;
        parent::__construct($formattedMessage);
    }
}
