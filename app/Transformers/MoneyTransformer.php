<?php

namespace App\Transformers;

use JetBrains\PhpStorm\Pure;

/**
 * Transforms money from integer into separated
 */
class MoneyTransformer
{
    public int $rubles;
    public int $kopecks;

    public function __construct(public int $value)
    {
        $this->rubles = (int) substr($this->value, 0, -2);
        $this->kopecks = (int) substr($this->value, -2);
    }

    public static function split(int $value)
    {
        return substr($value, 0, -2) .'.'. substr($value, -2);
    }

    public function getRubles(): int
    {
        return $this->rubles;
    }

    public function getKopecks(): int
    {
        return $this->kopecks;
    }

    #[Pure]
    public function getTotalStringWithSymbol(): string
    {
        $number = self::split($this->value);
        $formatted = number_format($number, 2, ',', ' ');
        return $formatted . ' ₽';
    }
}
