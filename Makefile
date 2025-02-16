MAKEFLAGS += --no-print-directory
CLI_ARGS ?= bash

init:
	$(MAKE) set-env
	$(MAKE) build
	$(MAKE) install-php-packages
	$(MAKE) generate-parser

install-php-packages:
	$(MAKE) cli CLI_ARGS="composer install"	

set-env:
	cp .env.dev .env

build:
	docker-compose build

cli:
	docker-compose run --rm cli-php $(CLI_ARGS)

generate-parser:
	docker-compose run --rm antlr antlr -Dlanguage=PHP FunctionalLang.g4 -package Abelapko\\Interpreter\\Parser\\Generated -o src/Parser/Generated

parse:
	$(MAKE) cli CLI_ARGS="php parser.php program.txt"

interpret:
	$(MAKE) cli CLI_ARGS="php interpreter.php program.txt world"

test:
	$(MAKE) cli CLI_ARGS="composer run test"

format:
	$(MAKE) cli CLI_ARGS="composer run cs-fix"