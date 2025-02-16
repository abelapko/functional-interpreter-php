<?php

namespace Abelapko\Interpreter\Ast;

class ConstantNode extends AstNode
{
    public string|int|bool|null|float $value;

    public function __construct(string|int|bool|null|float $value)
    {
        $this->value = $value;
    }

    public function toArray(): array
    {
        return ["constant" => $this->value];
    }
}
