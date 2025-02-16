<?php
namespace Abelapko\Interpreter\Tests\Executor\Functions;

use Abelapko\Interpreter\Executor\Executor;
use Abelapko\Interpreter\Executor\Functions\GetArgFunction;
use PHPUnit\Framework\TestCase;

class GetArgFunctionTest extends TestCase {

    public function testGetArg() {
        $executor = new Executor();
        $executor->setArgs(["param1", "param2"]);
        $function = new GetArgFunction($executor);
        $this->assertEquals("param1", $function->execute([0]));
        $this->assertEquals("param2", $function->execute([1]));
    }
}