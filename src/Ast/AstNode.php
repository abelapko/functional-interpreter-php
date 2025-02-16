<?php

namespace Abelapko\Interpreter\Ast;

abstract class AstNode
{
    abstract public function toArray(): array;
}
