<?php
namespace Abelapko\Interpreter\Tests\Executor\Functions;

use Abelapko\Interpreter\Executor\Functions\ConcatFunction;
use PHPUnit\Framework\TestCase;

class ConcatFunctionTest extends TestCase {
    public function testConcat() {
        $function = new ConcatFunction();
        $this->assertEquals("HelloWorld", $function->execute(["Hello", "World"]));
    }
}