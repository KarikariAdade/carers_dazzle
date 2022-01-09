<?php

namespace App\Http\Controllers\Website;

use App\Http\Controllers\Controller;
use App\Models\Regions;
use App\Models\Towns;
use App\Models\User;
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

        $user = auth()->guard('web')->user();

        if (empty($checkout_data)) {
            return redirect()->route('website.cart.index')->withErrors('Add items to cart before checking out');
        }

        if (empty($shipping_data)) {
            return redirect()->route('website.cart.index')->withErrors('Add shipping data before you checkout');
        }

        $region = Regions::query()->where('id', $shipping_data['shipping']['region'])->first();

        $town = Towns::query()->where('id', $shipping_data['shipping']['town'])->first();

        return view('website.checkout.index', ['pageItems' => $this->pageDependencies(), 'region' => $region, 'town' => $town, 'user' => $user]);
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


    public function order(Request $request)
    {
        $data = $request->all();

        $validate = Validator::make($data, $this->validateOrderFields(), ['account_password.required_with' => 'Account Password is required when Create an Account is checked']);

        if ($validate->fails()){
            return $this->failResponse($validate->errors()->first());
        }

        if(isset($data['create_pwd'])){
            $check_user = User::query()->where('email', $data['email'])->first();

            if (!empty($check_user)){
                return 'User exist';
            }

            return 'User does not exist';
        }

        return 'create account is not set';
    }


    public function validateOrderFields()
    {
        return [
            'name' => 'required',
            'email' => 'required|email',
            'order_note' => 'nullable',
            'payment_method' => 'required',
            'phone' => 'regex:/^([0-9\s\-\+\(\)]*)$/|min:10|max:18|required',
            'postcode' => 'required',
            'region' => 'required',
            'street_address' => 'required',
            'town' => 'required',
            'account_password' => 'required_with:create_pwd|min:8',
        ];
    }

    public function createUserAccount($data)
    {
        return [
            'name' => $data['name'],
            'email' => $data['email'],
            'phone' => $data['phone'],
            'region' => session()->get('delivery_bill.shipping.region') ?? null,
            'town' => session()->get('delivery_bill.shipping.town') ?? null,
            'street_address_1' => $data['street_address'],
            'street_address_2' => $data['street_address_secondary'],
            'password' => bcrypt($data['password']),
        ];
    }
}
