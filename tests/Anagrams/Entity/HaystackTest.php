<?php

namespace Anagrams\Entity;

use PHPUnit\Framework\TestCase;

class HaystackTest extends TestCase
{
    public function testEmptyString(): void
    {
        $this->expectException(\InvalidArgumentException::class);
        $this->expectExceptionMessage('haystack cannot be empty');

        $haystack = new Haystack('');
    }

    public function testTooLongString(): void
    {
        $this->expectException(\InvalidArgumentException::class);
        $this->expectExceptionMessage('haystack cannot have a length greater than 1024 chars');

        $haystack = new Haystack(str_repeat('a', 2000));
    }
}
