<?php

namespace App\Helpers;

class CPFHelper
{
    public static function generate()
    {
        $n = [];
        for ($i = 0; $i < 9; $i++) {
            $n[] = rand(0, 9);
        }

        $n[9] = self::calculateDigit($n, 10);
        $n[10] = self::calculateDigit($n, 11);

        return implode('', $n);
    }

    private static function calculateDigit($n, $length)
    {
        $sum = 0;
        for ($i = 0; $i < $length - 1; $i++) {
            $sum += $n[$i] * ($length - $i);
        }

        $remainder = $sum % 11;
        return $remainder < 2 ? 0 : 11 - $remainder;
    }
}
