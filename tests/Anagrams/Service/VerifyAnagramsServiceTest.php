<?php

namespace Anagrams\Service;

use PHPUnit\Framework\TestCase;
use Anagrams\Entity\Haystack;
use Anagrams\Entity\Needle;

class VerifyAnagramsServiceTest extends TestCase
{
    public function setUp(): void
    {
        $this->obj = new VerifyAnagramsService;
    }

    public function testDifferentStrings(): void
    {
        $haystack = new Haystack('a');
        $needle   = new Needle('b');
        $this->assertEquals(false, $this->obj->containsAnagram($haystack, $needle));
    }

    public function testNeedleLongerThanHaystack(): void
    {
        $this->expectException(\UnexpectedValueException::class);
        $this->expectExceptionMessage('the needle cannot be longer than the haystack');

        $haystack = new Haystack('a');
        $needle   = new Needle('ab');
        $this->assertEquals(false, $this->obj->containsAnagram($haystack, $needle));
    }

    public function testNeedleWithMatchingCharsNotInTheRightOrder(): void
    {
        $haystack = new Haystack('abcba');
        $needle   = new Needle('aba');
        $this->assertEquals(false, $this->obj->containsAnagram($haystack, $needle));
    }

    public function testEqualsStrings(): void
    {
        $haystack = new Haystack('a');
        $needle   = new Needle('a');
        $this->assertEquals(true, $this->obj->containsAnagram($haystack, $needle));
    }

    public function testEqualsStrings2(): void
    {
        $haystack = new Haystack('ab');
        $needle   = new Needle('ab');
        $this->assertEquals(true, $this->obj->containsAnagram($haystack, $needle));
    }

    public function testSortingNeedleWhenEqualString(): void
    {
        $haystack = new Haystack('ab');
        $needle   = new Needle('ba');
        $this->assertEquals(true, $this->obj->containsAnagram($haystack, $needle));
    }

    public function testSortingNeedleWhenEqualString2(): void
    {
        $haystack = new Haystack('abc');
        $needle   = new Needle('cba');
        $this->assertEquals(true, $this->obj->containsAnagram($haystack, $needle));
    }

    public function testSortingNeedleWhenEqualString3(): void
    {
        $haystack = new Haystack('abc');
        $needle   = new Needle('bca');
        $this->assertEquals(true, $this->obj->containsAnagram($haystack, $needle));
    }

    public function testNeedleContainedInHaystack(): void
    {
        $haystack = new Haystack('abcdef');
        $needle   = new Needle('bcd');
        $this->assertEquals(true, $this->obj->containsAnagram($haystack, $needle));
    }

    public function testSortedNeedleContainedInHaystack(): void
    {
        $haystack = new Haystack('abcdef');
        $needle   = new Needle('dcb');
        $this->assertEquals(true, $this->obj->containsAnagram($haystack, $needle));
    }

    public function testUnsortedHaystackAndUnsortedNeedleAtBeginning(): void
    {
        $haystack = new Haystack('dcafeb');
        $needle   = new Needle('cda');
        $this->assertEquals(true, $this->obj->containsAnagram($haystack, $needle));
    }

    public function testUnsortedHaystackAndUnsortedNeedleAtBeginningPartialMatching(): void
    {
        $haystack = new Haystack('dcafeb');
        $needle   = new Needle('cdz');
        $this->assertEquals(false, $this->obj->containsAnagram($haystack, $needle));
    }

    public function testUnsortedHaystackAndUnsortedNeedleAtMiddle(): void
    {
        $haystack = new Haystack('dcafeb');
        $needle   = new Needle('cfa');
        $this->assertEquals(true, $this->obj->containsAnagram($haystack, $needle));
    }

    public function testUnsortedHaystackAndUnsortedNeedleAtEnd(): void
    {
        $haystack = new Haystack('dcafeb');
        $needle   = new Needle('efb');
        $this->assertEquals(true, $this->obj->containsAnagram($haystack, $needle));
    }

    public function testUsingSpaces(): void
    {
        $haystack = new Haystack('a b');
        $needle   = new Needle('b a');
        $this->assertEquals(true, $this->obj->containsAnagram($haystack, $needle));
    }

    public function testUsingAccentedLetters(): void
    {
        $haystack = new Haystack('a è');
        $needle   = new Needle('è a');
        $this->assertEquals(true, $this->obj->containsAnagram($haystack, $needle));
    }

    public function testUsingSymbols(): void
    {
        $haystack = new Haystack('a €');
        $needle   = new Needle('€ a');
        $this->assertEquals(true, $this->obj->containsAnagram($haystack, $needle));
    }

    public function testUsingEmoji(): void
    {
        $haystack = new Haystack('a 🍺');
        $needle   = new Needle('🍺 a');
        $this->assertEquals(true, $this->obj->containsAnagram($haystack, $needle));
    }

    public function testUnsortedHaystackAndUnsortedNeedleAtEnd2(): void
    {
        $haystack = new Haystack('itookablackcab');
        $needle   = new Needle('abc');
        $this->assertEquals(true, $this->obj->containsAnagram($haystack, $needle));
    }

    public function testLongHaystack(): void
    {
        $haystack = new Haystack('abcdef'.str_repeat('a', 1000));
        $needle   = new Needle('bcd');
        $this->assertEquals(true, $this->obj->containsAnagram($haystack, $needle));
    }

    public function testLongStrings(): void
    {
        $haystack = new Haystack(str_repeat('aaa', 341));
        $needle   = new Needle(str_repeat('a', 1000));
        $this->assertEquals(true, $this->obj->containsAnagram($haystack, $needle));
    }
}
