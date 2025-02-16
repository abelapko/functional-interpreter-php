# Functional Language Interpreter

## About

This project is a **functional programming language interpreter** written in **PHP** and based on **[ANTLR](https://www.antlr.org/)** for parsing.
For a detailed description of the architecture, see [Project Architecture](docs/interpreter-structure.md).

---

## Demo

Run program:
<img src="/docs/demo-success.gif" alt="demo-success-case">

Try run program with invalid syntax:
<img src="/docs/demo-invalid.gif" alt="demo-invalid-case">

See more program examples [here](/docs/program-examples.md).

---

## Requirements

To run the project, ensure you have the following installed:

- **[GIT](https://git-scm.com/)**
- **[Docker](https://www.docker.com/)**
- **[Docker Compose](https://docs.docker.com/compose/)**
- **[Make](https://www.gnu.org/software/make/)**

---

## Install

1. Clone the repository:
```sh
git clone https://github.com/abelapko/functional-interpreter-php.git functional-interpreter
cd functional-interpreter
```

2. Initialize the environment and app:
```sh
make init
```

---

## User Guide

### Using the Interpreter

Attach to container CLI, and run interpreter:
```sh
make cli
```

```sh
php interpreter.php program.txt world
```

---

## Developer Guide

### Using the Parser

To use the parser:

```sh
make cli
```

```sh
php parser.php program.txt
```

### Running Tests

The project includes **[PHPUnit](https://phpunit.de/index.html)** tests. Run tests with:

```sh
make test
```

### Formatting Code

Ensure consistent code style with:

```sh
make format
```

This uses **[PHP CS Fixer](https://github.com/PHP-CS-Fixer/PHP-CS-Fixer)** to automatically format the code.

---

## Future Improvements

- Add caching for Parser layer
- Add performance test and logs
- Integrate [PHPStan](https://phpstan.org/)
