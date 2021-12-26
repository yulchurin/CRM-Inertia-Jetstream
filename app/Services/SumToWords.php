<?php

namespace App\Services;

use App\Transformers\MoneyTransformer;
use NumberFormatter;

class SumToWords
{
    /**
     * @param int $sum
     * @return string
     */
    public static function spell(int $sum): string
    {
        $value = MoneyTransformer::split($sum);
        $value = explode('.', number_format($value, 2, '.', ''));

        $f = new NumberFormatter('ru', NumberFormatter::SPELLOUT);
        $str = $f->format($value[0]);

        // Первую букву в верхний регистр.
        $str = mb_strtoupper(mb_substr($str, 0, 1)) . mb_substr($str, 1, mb_strlen($str));

        // Склонение слова "рубль".
        $num = $value[0] % 100;
        if ($num > 19) {
            $num = $num % 10;
        }
        switch ($num) {
            case 1: $rub = 'рубль'; break;
            case 2:
            case 3:
            case 4: $rub = 'рубля'; break;
            default: $rub = 'рублей';
        }

        return $str . ' ' . $rub . ' ' . $value[1] . ' коп.';
    }
}
