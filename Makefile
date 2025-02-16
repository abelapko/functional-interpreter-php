CLI_ARGS ?= bash

init:
	$(MAKE) generate-parser

cli:
	docker-compose run --rm cli-php $(CLI_ARGS)

generate-parser:
	docker-compose run --rm antlr antlr -Dlanguage=PHP FunctionalLang.g4 -package Abelapko\\Interpreter\\Parser\\Generated -o src/Parser/Generated

parse:
	$(MAKE) cli CLI_ARGS="php parser.php program.txt"

interpret:
	$(MAKE) cli CLI_ARGS="php interpreter.php program.txt world"