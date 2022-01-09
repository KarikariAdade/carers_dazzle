<?php

namespace App\Http\Controllers\Website;

use App\Http\Controllers\Controller;
use App\Models\Regions;
use App\Models\Towns;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;

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

        $region = Regions::query()->where('id', $shipping_data['shipping']['region'])->first();

        $town = Towns::query()->where('id', $shipping_data['shipping']['town'])->first();

        return view('website.checkout.index', ['pageItems' => $this->pageDependencies(), 'region' => $region, 'town' => $town]);
    }


    public function customerLogin(Request $request)
    {
        $data = $request->only(['email', 'password']);

        $validate = Validator::make($data, [
            'email' => 'required|email',
            'password' => 'required'
        ]);

        if ($validate->fails())
            return $this->failResponse($validate->errors()->first());

        if (Auth::guard('web')->attempt($data)){

            Session::flash('success', 'Welcome back, '.auth()->guard('web')->user()->name);

            return $this->successResponse('User logged in');
        }

        return $this->failResponse('Incorrect email address or password');
    }
}
