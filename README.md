# utf8_escape

Escape a UTF-8 string with the `\u1234` format.

## Requirements

* PHP >= 5.4

However, ***you should not be using EOL versions like this.*** I added Symfony's mb_polyfill to support PHP < 7.2 which had the side effect of making it work as far back as 5.4

## Installation

    composer require wrossmann\utf8_escape

## Usage

    $escaped = utf8_escape($string);

Component functions are `public static` and defined in `src/Escaper.php`.

## Caveats

This library does not strictly enforce that the input be well-formed UTF8 text and may misbehave if fed anything else.

As always _you_ are responsible for ensuring that input you've received is encoded the way you expecct it, and to _explicitly_ convert between source and destination encodings. Eg:

    mb_convert_encoding($input, 'UTF-8', 'ISO-8859-1')

`utf8_encode()` and `utf8_decode()` are not magic wands and will happily break your data. Never use them.

## Suggested reading

- https://en.wikipedia.org/wiki/UTF-8
