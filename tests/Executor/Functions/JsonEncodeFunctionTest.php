<?php
namespace Abelapko\Interpreter\Tests\Executor\Functions;

use Abelapko\Interpreter\Executor\Functions\JsonEncodeFunction;
use PHPUnit\Framework\TestCase;

class JsonEncodeFunctionTest extends TestCase {
    public function testJsonEncode() {
        $function = new JsonEncodeFunction();
        $this->assertEquals('"hello"', $function->execute(["hello"]));
    }
}