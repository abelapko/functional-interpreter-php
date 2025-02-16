<?php

namespace Abelapko\Interpreter\Parser;

use Abelapko\Interpreter\Exceptions\SyntaxErrorException;
use Antlr\Antlr4\Runtime\Error\Exceptions\RecognitionException;
use Antlr\Antlr4\Runtime\Error\Listeners\BaseErrorListener;
use Antlr\Antlr4\Runtime\Recognizer;

class AntlrErrorListener extends BaseErrorListener
{
    /**
     * @throws SyntaxErrorException
     */
    public function syntaxError(
        Recognizer $recognizer,
        ?object $offendingSymbol,
        int $line,
        int $charPositionInLine,
        string $msg,
        ?RecognitionException $exception = null
    ): void {
        throw new SyntaxErrorException($msg, $line, $charPositionInLine);
    }
}
