<?php

namespace App\Helpers;

use AmrShawky\LaravelCurrency\Facade\Currency;
use App\Models\Product;

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

            return session()->get('sign').number_format((float) $amount, 2);
        }

        return 'GHS '.number_format((float) $amount, 2);
    }


    public function runOrderProcesses($item)
    {

        $product = Product::query()->where('id', $item->id)->first();

        if (!empty($product)){

            $product->update([
                'orders' => $product->orders + 1,
                'quantity' => $product->quantity - $item->qty
            ]);

        }

        return null;

    }
}
