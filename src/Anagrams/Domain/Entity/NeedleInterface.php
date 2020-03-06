<?php

namespace Anagrams\Domain\Entity;

interface NeedleInterface
{
    public function getValue(): string;
    public function length(): int;
    public function toArray(): array;
    public function getSorted(): Needle;
}
