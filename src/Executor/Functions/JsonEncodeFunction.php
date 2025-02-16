<?php

namespace Abelapko\Interpreter\Executor\Functions;

class JsonEncodeFunction implements FunctionInterface
{
    public function execute(array $args): string|false
    {
        return json_encode($args[0]);
    }
}
