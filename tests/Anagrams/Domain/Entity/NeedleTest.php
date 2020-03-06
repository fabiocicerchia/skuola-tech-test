<?php

namespace Anagrams\Domain\Entity;

use PHPUnit\Framework\TestCase;

class NeedleTest extends TestCase
{
    public function testEmptyString(): void
    {
        $this->expectException(\InvalidArgumentException::class);
        $this->expectExceptionMessage('needle cannot be empty');

        $haystack = new Needle('');
    }

    public function testTooLongString(): void
    {
        $this->expectException(\InvalidArgumentException::class);
        $this->expectExceptionMessage('needle cannot have a length greater than 1024 chars');

        $haystack = new Needle(str_repeat('a', 2000));
    }
}
