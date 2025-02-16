<?php

namespace Abelapko\Interpreter\Executor;

use Abelapko\Interpreter\Exceptions\AstExecutionException;
use Abelapko\Interpreter\Executor\Functions\ArrayMakeFunction;
use Abelapko\Interpreter\Executor\Functions\ConcatFunction;
use Abelapko\Interpreter\Executor\functions\FunctionInterface;
use Abelapko\Interpreter\Executor\Functions\GetArgFunction;
use Abelapko\Interpreter\Executor\Functions\JsonEncodeFunction;
use Abelapko\Interpreter\Executor\Functions\MapMakeFunction;

class FunctionRegistry
{
    private array $functions = [];
    private Executor $interpreter;

    public function __construct(Executor $interpreter)
    {
        $this->interpreter = $interpreter;

        // Register built-in functions
        $this->register("bk.action.core.GetArg", new GetArgFunction($this->interpreter));
        $this->register("bk.action.string.Concat", new ConcatFunction());
        $this->register("bk.action.string.JsonEncode", new JsonEncodeFunction());
        $this->register("bk.action.array.Make", new ArrayMakeFunction());
        $this->register("bk.action.map.Make", new MapMakeFunction());
    }

    public function register(string $name, FunctionInterface $function): void
    {
        $this->functions[$name] = $function;
    }

    /**
     * @throws AstExecutionException
     */
    public function execute(string $name, array $args)
    {
        if (!isset($this->functions[$name])) {
            throw new AstExecutionException("Unknown function: $name");
        }
        return $this->functions[$name]->execute($args);
    }
}
