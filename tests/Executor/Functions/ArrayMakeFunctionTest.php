<?php
namespace Abelapko\Interpreter\Tests\Executor\Functions;

use Abelapko\Interpreter\Executor\Functions\ArrayMakeFunction;
use PHPUnit\Framework\TestCase;

class ArrayMakeFunctionTest extends TestCase {
    public function testArrayMake() {
        $function = new ArrayMakeFunction();
        $this->assertEquals([1, 2, 3], $function->execute([1, 2, 3]));
    }
}