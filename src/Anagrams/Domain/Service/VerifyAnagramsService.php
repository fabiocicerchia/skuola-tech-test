<?php

namespace Anagrams\Domain\Service;

use Anagrams\Domain\Entity\Haystack;
use Anagrams\Domain\Entity\Needle;

class VerifyAnagramsService
{
    /**
     * Verifies that a needle (or any of its anagrams) is contained in an haystack.
     * BigO: O(n)
     *
     * @param Haystack $haystack
     * @param Needle $needle
     * @return int a positive value is a match, a negative value is not
     */
    public function containsAnagram(Haystack $haystack, Needle $needle): bool
    {
        $haystackLength = $haystack->length();
        $needleLength   = $needle->length();
    
        if ($needleLength > $haystackLength) {
            throw new \UnexpectedValueException('the needle cannot be longer than the haystack');
        } elseif ($haystack->contains($needle) || $haystack->contains($needle->getSorted())) {
            return true;
        }
    
        $charsLeftInNeedle = $needle->toArray();

        for ($i = 0; $i < $haystackLength; $i++) {
            $char = $haystack->charAt($i);
            $pos  = array_search($char, $charsLeftInNeedle);
    
            if ($this->processChar($needle, $charsLeftInNeedle, $pos)) {
                return true;
            }
        }
    
        return $this->isAFullMatch($charsLeftInNeedle);
    }

    private function processChar(Needle $needle, array &$charsLeftInNeedle, $pos)
    {
        if ($pos === false) {
            // didn't find a consecutive match, reset the charsLeftInNeedle
            $charsLeftInNeedle = $needle->toArray();

            return;
        }

        if ($this->gotOneCharMatch($charsLeftInNeedle, $pos)) {
            return true;
        }
    }

    private function gotOneCharMatch(array &$charsLeftInNeedle, int $pos)
    {
        unset($charsLeftInNeedle[$pos]);
    
        // found last matching char of needle
        if ($this->isAFullMatch($charsLeftInNeedle)) {
            return true;
        }
    }

    private function isAFullMatch(array $charsLeftInNeedle)
    {
        return empty($charsLeftInNeedle);
    }
}
