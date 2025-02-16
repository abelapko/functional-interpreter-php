<?php

namespace Abelapko\Interpreter\Executor\Functions;

interface FunctionInterface
{
    public function execute(array $args);
}
