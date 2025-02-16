grammar FunctionalLang;

program       : expression EOF;
expression    : functionCall | constant;
functionCall  : '(' IDENTIFIER (',' parameters)? ')';
parameters    : expression (',' expression)*;
constant      : BOOLEAN | NULL | STRING | NUMBER;
BOOLEAN       : 'true' | 'false';
NULL          : 'null';
STRING        : '"' ~["]* '"';
NUMBER        : [0-9]+ ('.' [0-9]+)?;
IDENTIFIER    : [a-zA-Z_][a-zA-Z0-9_.]*;
WS            : [ \t\r\n]+ -> skip;
