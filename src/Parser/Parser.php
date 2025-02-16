<?php

namespace Abelapko\Interpreter\Parser;

use Abelapko\Interpreter\Ast\AstNode;
use Abelapko\Interpreter\Exceptions\AstBuildException;
use Abelapko\Interpreter\Exceptions\SyntaxErrorException;
use Abelapko\Interpreter\Parser\Generated\FunctionalLangLexer;
use Abelapko\Interpreter\Parser\Generated\FunctionalLangParser;
use Antlr\Antlr4\Runtime\CommonTokenStream;
use Antlr\Antlr4\Runtime\InputStream;
use Antlr\Antlr4\Runtime\Tree\ParseTreeWalker;
use Exception;
use RuntimeException;

class Parser
{
    public function __construct(private AstBuilder $AstBuilder)
    {
    }

    /**
     * @throws Exception
     * @throws AstBuildException
     * @throws SyntaxErrorException
     */
    public function parseCode(string $code): AstNode
    {
        $input = InputStream::fromString($code);
        $lexer = new FunctionalLangLexer($input);
        $tokens = new CommonTokenStream($lexer);
        $parser = new FunctionalLangParser($tokens);

        // Подключаем обработчик ошибок ANTLR
        $parser->removeErrorListeners();
        $parser->addErrorListener(new AntlrErrorListener());

        $tree = $parser->program();

        $walker = new ParseTreeWalker();
        $walker->walk($this->AstBuilder, $tree);

        return $this->AstBuilder->getAST();
    }

    /**
     * @throws Exception
     * @throws RuntimeException
     * @throws AstBuildException
     * @throws SyntaxErrorException
     */
    public function parseCodeFromFile(string $fileName): AstNode
    {
        if (!file_exists($fileName)) {
            throw new RuntimeException("File '$fileName' not found.");
        }

        $code = file_get_contents($fileName);

        return $this->parseCode($code);
    }
}
