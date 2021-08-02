<?php

use App\Models\Currency;

if (!function_exists('defaultCurrency')) {
    function defaultCurrrency($default='Ksh')
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