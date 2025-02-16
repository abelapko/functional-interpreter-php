<?php

use Abelapko\Interpreter\Parser\AstBuilder;
use Abelapko\Interpreter\Parser\Parser;

require_once 'vendor/autoload.php';

$parser = new Parser(new AstBuilder());

if ($argc < 2) {
    die("Usage: php parser.php <file>" . PHP_EOL);
}

$fileName = $argv[1];

try {
    $ast = $parser->parseCodeFromFile($fileName);
} catch (Exception $e) {
    fwrite(STDERR, "Error: " . $e->getMessage() . PHP_EOL);
    exit(1);
}

echo json_encode($ast->toArray(), JSON_PRETTY_PRINT);