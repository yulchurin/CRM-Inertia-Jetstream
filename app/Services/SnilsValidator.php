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

        $checksumCalculated = 0;
        for ($multiplier = 1; $multiplier < 10; ++$multiplier) {
            $checksumCalculated += $snilsDigitsArray[$multiplier - 1] * $multiplier;
        }

        return static::getExpected($checksumCalculated) === $checksum;
    }

    /**
     * Recursively gets expected checksum
     *
     * @param $calculated
     * @return int
     */
    private static function getExpected($calculated): int
    {
        if ($calculated < 100) {
            return $calculated;
        } elseif ($calculated === 100 || $calculated === 101) {
            return 0;
        } else {
            return static::getExpected($calculated % 101);
        }
    }
}
