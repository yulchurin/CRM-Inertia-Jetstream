<?php

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
        $value = MoneyTransformer::split($sum);
        $value = explode('.', number_format($value, 2, '.', ''));

        $f = new NumberFormatter('ru', NumberFormatter::SPELLOUT);
        $strRub = $f->format($value[0]);

        $rub = Lang::choice('рубль|рубля|рублей', $value[0], [], 'ru');
        $kop = Lang::choice('копейка|копейки|копеек', $value[1], [], 'ru');

        return $strRub .' '. $rub .' '. $value[1] .' '. $kop;
    }
}
