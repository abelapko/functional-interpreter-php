<?php

namespace Abelapko\Interpreter\Tests;

use Abelapko\Interpreter\Executor\Executor;
use Abelapko\Interpreter\Parser\AstBuilder;
use Abelapko\Interpreter\Parser\Parser;
use PHPUnit\Framework\TestCase;

class InterpreterTest extends TestCase {
    private $executor;
    private $parser;

    protected function setUp(): void {
        $this->parser = new Parser(new AstBuilder());
        $this->executor = new Executor();
    }

    public function testBasicExecution() {
        $code = "42";
        $ast = $this->parser->parseCode($code);
        $result = $this->executor->execute($ast);
        $this->assertEquals(42, $result, "Basic execution failed");
    }
}