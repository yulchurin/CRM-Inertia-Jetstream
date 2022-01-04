<?php

declare(strict_types=1);

namespace App\Services;

use Illuminate\Support\Str;

class SnilsValidator
{
    /**
     * Validates SNILS by checksum
     *
     * @param string $snils
     * @return bool
     */
    public static function validate(string $snils): bool
    {
        $snils = Str::remove('-', $snils);
        $snils = Str::remove(' ', $snils);
        $checksum = (int) Str::substr($snils, -2);
        $snils = Str::substr($snils, 0,9);
        $snils = Str::reverse($snils);
        $snilsDigitsArray = array_map('intval', str_split($snils));

        $checksumExpected = 0;
        for ($multiplier = 1; $multiplier < 10; ++$multiplier) {
            $checksumExpected += $multiplier * $snilsDigitsArray[$multiplier-1];
        }

        return static::getExpected($checksumExpected) === $checksum;
    }

    /**
     * Recursively gets expected checksum
     *
     * @param $checkSumExpected
     * @return int
     */
    private static function getExpected($checkSumExpected): int
    {
        if ($checkSumExpected < 100) {
            return $checkSumExpected;
        } elseif ($checkSumExpected === 100 || $checkSumExpected === 101) {
            return 0;
        } else {
            return static::getExpected($checkSumExpected % 101);
        }
    }
}
