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

## Usage

### Quick & Dirty Version

```
$ php quickdirty.php
Usage: script.php haystack needle
```
