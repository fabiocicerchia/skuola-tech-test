<?php

namespace Anagrams\Domain\Entity;

class Haystack implements HaystackInterface
{
    protected $value = '';

    public function __construct(string $value)
    {
        if (mb_strlen($value) === 0) {
            throw new \InvalidArgumentException('haystack cannot be empty');
        } elseif (mb_strlen($value) > 1024) {
            throw new \InvalidArgumentException('haystack cannot have a length greater than 1024 chars');
        }

        $this->value = $value;
    }

    public function getValue(): string
    {
        return $this->value;
    }

    public function length(): int
    {
        return mb_strlen($this->value);
    }

    public function contains(NeedleInterface $needle): bool
    {
        return mb_strpos($this->value, $needle->getValue()) !== false;
    }

    public function charAt(int $pos): string
    {
        return mb_substr($this->value, $pos, 1);
    }
}
