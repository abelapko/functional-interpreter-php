<?php
require_once 'vendor/autoload.php';

use Abelapko\Interpreter\Exceptions\AstExecutionException;
use Abelapko\Interpreter\Interpreter;
use Abelapko\Interpreter\Parser\Parser;
use Abelapko\Interpreter\Parser\AstBuilder;
use Abelapko\Interpreter\Executor\Executor;
use Abelapko\Interpreter\Exceptions\SyntaxErrorException;

try {
    $interpreter = new Interpreter(
        new Parser(new AstBuilder()),
        new Executor()
    );

    if ($argc < 2) {
        die("Usage: php interpreter.php <file> [args...]" . PHP_EOL);
    }

    $filename = $argv[1];
    $args = array_slice($argv, 2);

    echo $interpreter->interpretFromFile($filename, $args) . PHP_EOL;
} catch (SyntaxErrorException $e) {
    fwrite(STDERR, "Error: " . $e->getMessage() . PHP_EOL);
    exit(1);
} catch (AstExecutionException $e) {
    fwrite(STDERR, "Runtime error: " . $e->getMessage() . PHP_EOL);
    exit(1);
} catch (Exception $e) {
    fwrite(STDERR, "Fatal Error: " . $e->getMessage() . PHP_EOL);
    exit(1);
}
