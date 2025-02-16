<?php

namespace Abelapko\Interpreter\Executor\Functions;

use Abelapko\Interpreter\Executor\Executor;

class GetArgFunction implements FunctionInterface
{
    private Executor $interpreter;

    public function __construct(Executor $interpreter)
    {
        $this->interpreter = $interpreter;
    }

    public function execute(array $args)
    {
        $index = isset($args[0]) ? intval($args[0]) : 0;
        return $this->interpreter->getArg($index);
    }
}
