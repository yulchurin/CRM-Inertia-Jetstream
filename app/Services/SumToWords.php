<?php

declare(strict_types=1);

namespace App\Services;

use App\Transformers\MoneyTransformer;
use Illuminate\Support\Facades\Lang;
use NumberFormatter;

class SumToWords
{
    /**
     * @param int $sum
     * @return string
     */
    public static function spell(int $sum): string
    {
        $rubles = MoneyTransformer::getRubles($sum);
        $kopeck = MoneyTransformer::getKopecks($sum);

        $formatter = new NumberFormatter('ru', NumberFormatter::SPELLOUT);
        $strRub = $formatter->format($rubles);

        $rub = Lang::choice('рубль|рубля|рублей', $rubles, [], 'ru');
        $kop = Lang::choice('копейка|копейки|копеек', $kopeck, [], 'ru');

        $kopeck = $kopeck > 9 ? $kopeck : "0$kopeck";

        return "$strRub $rub $kopeck $kop";
    }
}
