<?php
namespace Abelapko\Interpreter\Tests\Parser;

use Abelapko\Interpreter\Parser\AstBuilder;
use PHPUnit\Framework\TestCase;
use Abelapko\Interpreter\Parser\Parser;

class ParserTest extends TestCase {
    private $parser;

    protected function setUp(): void {
        $this->parser = new Parser(new AstBuilder());
    }

    public function testParsingSimpleExpression() {
        $code = "42";
        $ast = $this->parser->parseCode($code);
        $this->assertNotNull($ast, "Parsing failed: AST is null");
    }
}