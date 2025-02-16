<?php

namespace Abelapko\Interpreter;

use Abelapko\Interpreter\Exceptions\AstExecutionException;
use Abelapko\Interpreter\Exceptions\SyntaxErrorException;
use Abelapko\Interpreter\Executor\Executor;
use Abelapko\Interpreter\Parser\Parser;
use Exception;
use RuntimeException;

class Interpreter
{
    public function __construct(
        private Parser   $parser,
        private Executor $executor
    ) {
    }

    /**
     * @throws Exception
     * @throws SyntaxErrorException
     * @throws AstExecutionException
     */
    public function interpret(string $code, array $args): string
    {
        $ast = $this->parser->parseCode($code);

        return $this->executor->execute($ast, $args);
    }

    /**
     * @throws Exception
     * @throws RuntimeException
     * @throws SyntaxErrorException
     * @throws AstExecutionException
     */
    public function interpretFromFile(string $fileName, array $args): string
    {
        if (!file_exists($fileName)) {
            throw new RuntimeException("File '$fileName' not found.");
        }

        $code = file_get_contents($fileName);

        return $this->interpret($code, $args);
    }
}
