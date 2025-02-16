<?php

namespace Abelapko\Interpreter\Executor\Handlers;

use Abelapko\Interpreter\Ast\AstNode;
use Abelapko\Interpreter\Ast\ConstantNode;
use Abelapko\Interpreter\Exceptions\AstExecutionException;

class ConstantHandler implements NodeHandlerInterface
{
    /**
     * @throws AstExecutionException
     */
    public function handle(ASTNode $node): mixed
    {
        if (!$node instanceof ConstantNode) {
            throw new AstExecutionException("Invalid AST node type", "Constant");
        }
        return $this->extractConstant($node->value);
    }

    private function extractConstant($constant): mixed
    {
        if ($constant === "true") {
            return true;
        }
        if ($constant === "false") {
            return false;
        }
        if ($constant === "null") {
            return null;
        }
        if (is_numeric($constant)) {
            return $constant + 0;
        }
        return trim($constant, "\"");
    }
}
