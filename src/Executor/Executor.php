<?php

namespace Abelapko\Interpreter\Executor;

use Abelapko\Interpreter\Ast\AstNode;
use Abelapko\Interpreter\Ast\ConstantNode;
use Abelapko\Interpreter\Ast\FunctionNode;
use Abelapko\Interpreter\Exceptions\AstExecutionException;
use Abelapko\Interpreter\Executor\Handlers\ConstantHandler;
use Abelapko\Interpreter\Executor\Handlers\FunctionCallHandler;

class Executor
{
    private FunctionRegistry $functionRegistry;
    private array $programArgs = [];
    private array $handlers = [];

    public function __construct()
    {
        $this->functionRegistry = new FunctionRegistry($this);

        $this->handlers = [
            FunctionNode::class => new FunctionCallHandler($this->functionRegistry, $this),
            ConstantNode::class => new ConstantHandler(),
        ];
    }

    /**
     * @throws AstExecutionException
     */
    public function execute(AstNode $ast, array $args = [])
    {
        if (!empty($args)) {
            $this->programArgs = $args;
        }

        $nodeType = get_class($ast);
        if (isset($this->handlers[$nodeType])) {
            return $this->handlers[$nodeType]->handle($ast);
        }

        throw new AstExecutionException("Unknown AST node type", $nodeType);
    }

    public function setArgs(array $args): void
    {
        $this->programArgs = $args;
    }

    public function getArg(int $index): mixed
    {
        return $this->programArgs[$index] ?? null;
    }
}
