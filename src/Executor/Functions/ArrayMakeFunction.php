<?php

namespace Abelapko\Interpreter\Executor\Functions;

class ArrayMakeFunction implements FunctionInterface
{
    public function execute(array $args): array
    {
        return $args;
    }
}
