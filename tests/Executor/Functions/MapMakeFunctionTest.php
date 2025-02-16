<?php
namespace Abelapko\Interpreter\Tests\Executor\Functions;

use Abelapko\Interpreter\Executor\Functions\MapMakeFunction;
use PHPUnit\Framework\TestCase;

class MapMakeFunctionTest extends TestCase {
    public function testMapMake() {
        $function = new MapMakeFunction();
        $this->assertEquals(["a" => 1, "b" => 2], $function->execute([["a", "b"], [1, 2]]));
    }
}