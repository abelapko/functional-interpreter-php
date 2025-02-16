<?php
namespace Abelapko\Interpreter\Tests\Executor;

use Abelapko\Interpreter\Exceptions\AstExecutionException;
use Abelapko\Interpreter\Exceptions\SyntaxErrorException;
use Abelapko\Interpreter\Parser\AstBuilder;
use PHPUnit\Framework\TestCase;
use Abelapko\Interpreter\Executor\Executor;
use Abelapko\Interpreter\Parser\Parser;

class ExecutorTest extends TestCase {
    private $executor;
    private $parser;

    protected function setUp(): void {
        $this->parser = new Parser(new AstBuilder());
        $this->executor = new Executor();
    }

    public function testExecutionConstant() {
        $code = "42";
        $ast = $this->parser->parseCode($code);
        $result = $this->executor->execute($ast);
        $this->assertEquals(42, $result, "Execution of constant failed");
    }

    public function testExecutionString() {
        $code = "\"Hello\"";
        $ast = $this->parser->parseCode($code);
        $result = $this->executor->execute($ast);
        $this->assertEquals("Hello", $result, "Execution of string failed");
    }

    public function testExecutionBoolean() {
        $code = "true";
        $ast = $this->parser->parseCode($code);
        $result = $this->executor->execute($ast);
        $this->assertTrue($result, "Execution of boolean 'true' failed");
    }

    public function testExecutionNull() {
        $code = "null";
        $ast = $this->parser->parseCode($code);
        $result = $this->executor->execute($ast);
        $this->assertNull($result, "Execution of null failed");
    }

    public function testExecutionEmptyString() {
        $code = "\"\"";
        $ast = $this->parser->parseCode($code);
        $result = $this->executor->execute($ast);
        $this->assertEmpty($result, "Execution of empty string failed");
    }

    public function testExecutionFloat() {
        $code = "3.14";
        $ast = $this->parser->parseCode($code);
        $result = $this->executor->execute($ast);
        $this->assertIsFloat($result, "Execution of float failed");
    }

    public function testExecutionArrayMake() {
        $code = "(bk.action.array.Make, 1, 2, 3)";
        $ast = $this->parser->parseCode($code);
        $result = $this->executor->execute($ast);
        $this->assertEquals([1, 2, 3], $result, "Execution of array.Make failed");
    }

    public function testExecutionMapMake() {
        $code = "(bk.action.map.Make, (bk.action.array.Make, \"a\", \"b\"), (bk.action.array.Make, 1, 2))";
        $ast = $this->parser->parseCode($code);
        $result = $this->executor->execute($ast);
        $this->assertEquals(["a" => 1, "b" => 2], $result, "Execution of map.Make failed");
    }

    public function testExecutionJsonEncode() {
        $code = "(bk.action.string.JsonEncode, \"Hello\")";
        $ast = $this->parser->parseCode($code);
        $result = $this->executor->execute($ast);
        $this->assertEquals('"Hello"', $result, "Execution of JsonEncode failed");
    }

    public function testExecutionConcat() {
        $code = "(bk.action.string.Concat, \"Hello\", \" World\")";
        $ast = $this->parser->parseCode($code);
        $result = $this->executor->execute($ast);
        $this->assertEquals("Hello World", $result, "Execution of Concat failed");
    }

    public function testExecutionGetArg() {
        $code = "(bk.action.core.GetArg, 0)";
        $ast = $this->parser->parseCode($code);
        $result = $this->executor->execute($ast, ['param1']);
        $this->assertNotNull($result, "Execution of GetArg failed");
    }

    public function testExecutionNestedFunctions() {
        $code = "(bk.action.string.JsonEncode, (bk.action.string.Concat, \"Hello, \", (bk.action.core.GetArg, 0)))";
        $ast = $this->parser->parseCode($code);
        $result = $this->executor->execute($ast);
        $this->assertEquals('"Hello, "', substr($result, 0, 9), "Execution of nested functions failed");
    }

    public function testInterpretSyntaxError() {
        $this->expectException(SyntaxErrorException::class);
        $code = "(bk.action.string.Concat, \"Hello\""; // Missing closing parenthesis
        $ast = $this->parser->parseCode($code);
        $this->executor->execute($ast);
    }

    public function testInterpretUndefinedFunction() {
        $this->expectException(AstExecutionException::class);
        $code = "(bk.action.unknown.Function, \"Test\")";
        $ast = $this->parser->parseCode($code);
        $this->executor->execute($ast);
    }
}
