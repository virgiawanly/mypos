<?php

namespace App\Helpers;

class CurrencyHelper
{
    public static function formatCurrency($value, $prefix = '', $suffix = ''): string
    {
        return $prefix . number_format($value, 0, ',', '.') . $suffix;
    }
}
