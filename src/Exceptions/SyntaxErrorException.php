<?php

namespace Abelapko\Interpreter\Exceptions;

use Exception;

class SyntaxErrorException extends Exception
{
    public function __construct(string $message, int $line = 0, int $position = 0)
    {
        $formattedMessage = "Syntax error at line $line, position $position: $message";
        parent::__construct($formattedMessage);
    }
}
