<?php

namespace App\Helpers;

use AmrShawky\LaravelCurrency\Facade\Currency;

class ShopHelper
{
    public function calculateExchangeRate($amount)
    {
        if (!empty(session()->get('from_currency')) && !empty(session()->get('to_currency'))){
            $amount = Currency::convert()
                ->from(session()->get('from_currency'))
                ->to(session()->get('to_currency'))
                ->amount($amount)
                ->get();

            return session()->get('sign').' '.number_format($amount, 2);
        }

        return 'GHS '.number_format($amount, 2);
    }
}
