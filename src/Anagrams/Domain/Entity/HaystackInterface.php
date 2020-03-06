<?php

namespace Anagrams\Domain\Entity;

interface HaystackInterface
{
    public function getValue(): string;
    public function length(): int;
    public function contains(NeedleInterface $needle): bool;
    public function charAt(int $pos): string;
}
