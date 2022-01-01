<?php

namespace App\Http\Controllers\Website;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class CheckoutController extends Controller
{
    public function index()
    {
        $checkout_data = session()->get('checkout_data');

        $shipping_data = session()->get('delivery_bill');

        if (empty($checkout_data)) {
            return redirect()->route('website.cart.index')->withErrors('Add items to cart before checking out');
        }

        if (empty($shipping_data)) {
            return redirect()->route('website.cart.index')->withErrors('Add shipping data before you checkout');
        }

        return view('website.checkout.index', ['pageItems' => $this->pageDependencies()]);
    }
}
