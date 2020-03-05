<?php

namespace Anagrams\Service;

use Anagrams\Entity\Haystack;
use Anagrams\Entity\Needle;

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
    public function containsAnagram(Haystack $haystack, Needle $needle): int
    {
        $haystackLength = mb_strlen($haystack->getValue());
        $needleLength   = mb_strlen($needle->getValue());
    
        if ($needleLength > $haystackLength) {
            throw new \UnexpectedValueException('the needle cannot be longer than the haystack');
        } elseif ($haystack->contains($needle->getValue()) || $haystack->contains($needle->getSortedValue())) {
            return true;
        }
    
        $charsLeftInNeedle = $needle->toArray();

        for ($i = 0; $i < $haystackLength; $i++) {
            $char = $haystack->charAt($i);
            $pos  = array_search($char, $charsLeftInNeedle);
    
            if ($pos !== false) {
                unset($charsLeftInNeedle[$pos]);
    
                // found last matching char of needle
                if (empty($charsLeftInNeedle)) {
                    return true;
                }
            } else {
                // didn't find a consecutive match, reset the charsLeftInNeedle
                $charsLeftInNeedle = $needle->toArray();
            }
        }
    
        return empty($charsLeftInNeedle);
    }
}
