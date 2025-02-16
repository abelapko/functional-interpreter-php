<?php

namespace Abelapko\Interpreter\Executor\Handlers;

use Abelapko\Interpreter\Ast\AstNode;

interface NodeHandlerInterface
{
    public function handle(AstNode $node);
}
