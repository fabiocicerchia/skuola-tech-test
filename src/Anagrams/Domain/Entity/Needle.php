<?php

namespace Anagrams\Domain\Entity;

class Needle
{
    protected $value = '';

    public function __construct(string $value)
    {
        if (mb_strlen($value) === 0) {
            throw new \InvalidArgumentException('needle cannot be empty');
        } elseif (mb_strlen($value) > 1024) {
            throw new \InvalidArgumentException('needle cannot have a length greater than 1024 chars');
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

    public function toArray(): array
    {
        return preg_split('//u', $this->value, null, PREG_SPLIT_NO_EMPTY);
    }

    public function getSorted(): self
    {
        $needleChars = $this->toArray();
        sort($needleChars);
        $needleSorted = implode($needleChars);

        return new Needle($needleSorted);
    }
}
