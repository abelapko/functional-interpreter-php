<?php

namespace Abelapko\Interpreter\Executor\Handlers;

use Abelapko\Interpreter\Ast\AstNode;
use Abelapko\Interpreter\Ast\FunctionNode;
use Abelapko\Interpreter\Exceptions\AstExecutionException;
use Abelapko\Interpreter\Executor\FunctionRegistry;
use Abelapko\Interpreter\Executor\Executor;

class FunctionCallHandler implements NodeHandlerInterface
{
    private FunctionRegistry $functionRegistry;
    private Executor $interpreter;

    public function __construct(FunctionRegistry $functionRegistry, Executor $interpreter)
    {
        $this->functionRegistry = $functionRegistry;
        $this->interpreter = $interpreter;
    }

    /**
     * @throws AstExecutionException
     */
    public function handle(AstNode $node): mixed
    {
        if (!$node instanceof FunctionNode) {
            throw new AstExecutionException("Invalid AST node type", "FunctionCall");
        }

        $funcName = $node->function;
        $params = array_map(fn ($arg) => $this->interpreter->execute($arg), $node->args);

        return $this->functionRegistry->execute($funcName, $params);
    }
}
