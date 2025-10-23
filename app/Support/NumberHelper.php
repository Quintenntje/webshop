<?php

namespace App\Support;

class NumberHelper
{
    public static function toFixed(float $number, int $decimals = 2): string
    {
        return number_format($number, $decimals, '.', '');
    }
}
