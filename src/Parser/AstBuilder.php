<?php

namespace Abelapko\Interpreter\Parser;

use Abelapko\Interpreter\Ast\AstNode;
use Abelapko\Interpreter\Ast\ConstantNode;
use Abelapko\Interpreter\Ast\FunctionNode;
use Abelapko\Interpreter\Parser\Generated\FunctionalLangBaseListener;
use Abelapko\Interpreter\Exceptions\AstBuildException;

class AstBuilder extends FunctionalLangBaseListener
{
    private ?ASTNode $ast = null;

    /**
     * @throws AstBuildException
     */
    public function exitFunctionCall($ctx): void
    {
        if (!$ctx->IDENTIFIER()) {
            throw new AstBuildException("Function name is missing in function call.");
        }

        $funcName = $ctx->IDENTIFIER()->getText();
        $args = $ctx->parameters() ? array_map(
            fn($expr) => $this->processExpression($expr),
            $ctx->parameters()->expression()
        ) : [];

        $this->ast = new FunctionNode($funcName, $args);
    }

    /**
     * @throws AstBuildException
     */
    public function exitConstant($ctx): void
    {
        $text = $ctx->getText();
        if ($text === null) {
            throw new AstBuildException("Invalid constant value.");
        }

        $this->ast = new ConstantNode($text);
    }

    /**
     * @throws AstBuildException
     */
    private function processExpression($expr): AstNode
    {
        if ($expr->functionCall()) {
            return $this->processFunctionCall($expr->functionCall());
        }

        if ($expr->constant()) {
            return $this->processConstant($expr->constant());
        }

        throw new AstBuildException("Unexpected AST structure in expression.");
    }

    /**
     * @throws AstBuildException
     */
    private function processFunctionCall($ctx): FunctionNode
    {
        if (!$ctx->IDENTIFIER()) {
            throw new AstBuildException("Function name is missing.");
        }

        return new FunctionNode(
            $ctx->IDENTIFIER()->getText(),
            $ctx->parameters() ? array_map([$this, 'processExpression'], $ctx->parameters()->expression()) : []
        );
    }

    private function processConstant($ctx): ConstantNode
    {
        return new ConstantNode($ctx->getText());
    }

    /**
     * @throws AstBuildException
     */
    public function getAST(): ASTNode
    {
        if ($this->ast === null) {
            throw new AstBuildException("AST has not been built.");
        }

        return $this->ast;
    }
}
