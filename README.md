# TECH TEST

## Objective
Check that an anagram of a string is contained in another string.

## Task
Prepare a command-line script which accepts 2 strings in input, checks if a given
string A is any anagram contained in a string B, and prints out  "true" or "false"
based on the result of such comparison.

Assume that:

 - The code will be implemented preferably in PHP.
 - A is a string no longer than 1024 characters.
 - B is a string no longer than 1024 characters.
 - No native language functions will be used to anagram a string.
 - The comparison will be case-insensitive.
 
### Example
Given 2 strings A = "abc" and B = "itookablackcab", the scripts will print out
"true", because by anagramming A it can be found an occurrence of "cab" in the
string B.

---

## Requirements

 - PHP 7.2+
 - PHPDBG (for tests)

## Usage

### Quick & Dirty Version

```
$ php quickdirty.php
Usage: script.php haystack needle
```

### Clean Version

```
$ ./bin/console --help
Description:
  Verifies that a needle (or any of its anagrams) is contained in an haystack.

Usage:
  verify:anagrams <haystack> <needle>

Arguments:
  haystack              Haystack
  needle                Needle

Options:
  -h, --help            Display this help message
  -q, --quiet           Do not output any message
  -V, --version         Display this application version
      --ansi            Force ANSI output
      --no-ansi         Disable ANSI output
  -n, --no-interaction  Do not ask any interactive question
  -v|vv|vvv, --verbose  Increase the verbosity of messages: 1 for normal output, 2 for more verbose output and 3 for debug
```

## Tests

```
$ composer run-scripts tests
> phpdbg -qrr ./vendor/bin/phpunit
PHPUnit 9.0.1 by Sebastian Bergmann and contributors.

Runtime:       PHPDBG 7.3.12
Configuration: /Users/fabiocicerchia/techtest/phpunit.xml

.........................                                         25 / 25 (100%)

Time: 104 ms, Memory: 8.00 MB

OK (25 tests, 30 assertions)

Generating code coverage report in HTML format ... done [214 ms]
```
