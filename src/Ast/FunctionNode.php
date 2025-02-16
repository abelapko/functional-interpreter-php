<?php

namespace Abelapko\Interpreter\Ast;

class FunctionNode extends AstNode
{
    public string $function;
    public array $args;

    public function __construct(string $function, array $args = [])
    {
        $this->function = $function;
        $this->args = $args;
    }

    public function toArray(): array
    {
        return [
            "function" => $this->function,
            "args" => array_map(fn ($arg) => $arg->toArray(), $this->args)
        ];
    }
}
