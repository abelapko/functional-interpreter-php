<?php

namespace Abelapko\Interpreter\Executor\Functions;

class ConcatFunction implements FunctionInterface
{
    public function execute(array $args): string
    {
        return implode("", $args);
    }
}
