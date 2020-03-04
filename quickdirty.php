<?php

if (count($_SERVER['argv']) === 1) {
    die("Usage: quickdirty.php haystack needle");
}

$a = mb_strtolower($_SERVER['argv'][1]);
$b = mb_strtolower($_SERVER['argv'][2]);

assert(mb_strlen($a) <= 1024);
assert(mb_strlen($b) <= 1024);
assert(mb_strlen($a) > 0);
assert(mb_strlen($b) > 0);

/**
 * Verifies that a needle (or any of its anagrams) is contained in an haystack.
 * BigO: O(n)
 *
 * @param string $haystack
 * @param string $needle
 * @return int a positive value is a match, a negative value is not
 */
function containsAnagram(string $haystack, string $needle): int
{
    $haystackLength = mb_strlen($haystack);
    $needleLength   = mb_strlen($needle);

    if ($haystackLength === 0) {
        return -1;
    } elseif ($needleLength === 0 || $needleLength > $haystackLength) {
        return -2;
    } elseif ($haystack === $needle) {
        return 1;
    }

    $needleChars = preg_split('//u', $needle, null, PREG_SPLIT_NO_EMPTY);
    sort($needleChars);
    $needleSorted = implode($needleChars);

    if ($haystack === $needleSorted) {
        return 2;
    } elseif (mb_strpos($haystack, $needle) !== false) {
        return 3;
    } elseif (mb_strpos($haystack, $needleSorted) !== false) {
        return 4;
    }

    $tmpNeedle = $needleChars;
    $found = false;
    for ($i = 0; $i < $haystackLength; $i++) {
        $char = mb_substr($haystack, $i, 1);
        $pos  = array_search($char, (array) $tmpNeedle);

        if ($pos !== false) {
            unset($tmpNeedle[$pos]);

            // got one matching char (counts only the first match)
            $found = true;

            // found last matching char of needle
            if (empty($tmpNeedle)) {
                return 5;
            }
        } else {
            // didn't find a consecutive match, reset the tmpNeedle
            $tmpNeedle = $needleChars;
        }
    }

    return empty($tmpNeedle) && $found;
}

// TESTS
/*
assert(containsAnagram('', '') === -1); // empty strings
assert(containsAnagram('', 'a') === -1); // empty haystack
assert(containsAnagram('a', '') === -2); // empty needle
assert(containsAnagram('a', 'b') === false); // different strings
assert(containsAnagram('a', 'ab') === -2); // needle longer than haystack
assert(containsAnagram('a', 'aa') === -2); // needle longer than haystack #2
assert(containsAnagram('abcba', 'aba') === false); // needle with matching chars not in the right order
assert(containsAnagram('a', 'a') === 1); // equals strings
assert(containsAnagram('ab', 'ab') === 1); // equals strings #2
assert(containsAnagram('ab', 'ba') === 2); // sorting needle when equal string
assert(containsAnagram('abc', 'cba') === 2); // sorting needle when equal string #2
assert(containsAnagram('abc', 'bca') === 2); // sorting needle when equal string #2
assert(containsAnagram('abcdef', 'bcd') === 3); // needle contained in haystack
assert(containsAnagram('abcdef', 'dcb') === 4); // sorted needle contained in haystack
assert(containsAnagram('dcafeb', 'cda') === 5); // unsorted haystack and unsorted needle at beginning
assert(containsAnagram('dcafeb', 'cdz') === false); // unsorted haystack and unsorted needle at beginning (partial matching)
assert(containsAnagram('dcafeb', 'cfa') === 5); // unsorted haystack and unsorted needle at middle
assert(containsAnagram('dcafeb', 'efb') === 5); // unsorted haystack and unsorted needle at end
assert(containsAnagram('a b', 'b a') === 5); // using spaces
assert(containsAnagram('a è', 'è a') === 5); // using accented letters
assert(containsAnagram('a €', '€ a') === 5); // using symbols
assert(containsAnagram('a 🍺', '🍺 a') === 5); // using emoji
assert(containsAnagram('itookablackcab', 'abc') === 5); // unsorted haystack and unsorted needle at end
assert(containsAnagram('abcdef'.str_repeat('a', 1000), 'bcd') === 3); // long haystack
assert(containsAnagram(str_repeat('aaa', 341), str_repeat('a', 1000)) === 3); // long strings
*/

$result = containsAnagram($a, $b);
echo(($result > 0) ? 'true' : 'false') . PHP_EOL;
