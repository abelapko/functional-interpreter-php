<?php

namespace Abelapko\Interpreter\Executor\Functions;

use Exception;

class MapMakeFunction implements FunctionInterface
{
    /**
     * @throws Exception
     */
    public function execute(array $args): array
    {
        if (!is_array($args[0]) || !is_array($args[1]) || count($args[0]) !== count($args[1])) {
            throw new Exception("Invalid map structure: keys and values must be arrays of the same length.");
        }
        return array_combine($args[0], $args[1]);
    }
}
