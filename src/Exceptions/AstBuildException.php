<?php

namespace Abelapko\Interpreter\Exceptions;

use Exception;

class AstBuildException extends Exception
{
    public function __construct(string $message)
    {
        parent::__construct("AST Build Error: " . $message);
    }
}
