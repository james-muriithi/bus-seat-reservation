<?php

use App\Models\Currency;

if (!function_exists('defaultCurrency')) {
    function defaultCurrrency($default = 'Ksh')
    {
        $defaultCurrencyId = config('settings')['default_currency_id'] ?? null;
        if (!$defaultCurrencyId) {
            return $default;
        }

        $currency = Currency::find($defaultCurrencyId);
        if ($currency) {
            return $currency->currency_symbol;
        }

        return $default;
    }
}

if (!function_exists('getPercent')) {
    function getPercent($value, $total, $appendPercent=true)
    {
        $percent = ($value / $total) * 100;
        if ($appendPercent) {
            $percent .= '%';
        }
        return $percent;
    }
}
