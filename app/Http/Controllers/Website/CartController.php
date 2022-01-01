<?php

namespace App\Http\Controllers\Website;

use App\Http\Controllers\Controller;
use App\Models\Coupon;
use App\Models\Product;
use App\Models\Regions;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;

class CartController extends Controller
{

    public function index()
    {
        $regions = Regions::query()->get();

        return view('website.cart.index', ['pageItems' => $this->pageDependencies(), 'regions' => $regions]);
    }

    public function computeCoupon()
    {
        $coupon = session()->get('checkout_data.coupon');

        if(!empty($coupon))
            $coupon_discount = $this->calculateDiscount($coupon->amount_type, $coupon->amount, Cart::subtotal(0, '', ''));


        $checkout_amount = [
            'card' => Cart::content(),
            'total' => $coupon ? Cart::subtotal(0, '', '') - (Cart::subtotal(0, '', '') - $this->calculateDiscount($coupon->amount_type, $coupon->amount)) : Cart::subtotal(0, '', ''),
            'delivery' => session()->get('delivery_bill') ?? 0,
//            'sub_total' => $coupon ? (Cart::subtotal(0,'', '') - $cart->price) - $coupon : 0,

//            'originalcart_price' => $cart->price,
            'sub_total' => $coupon ? Cart::subtotal(0, '', '') - $this->calculateDiscount($coupon->amount_type, $coupon->amount) : 0,
            'coupon' => session()->get('checkout_data.coupon')
        ];

        session()->put('checkout_data', $checkout_amount);
    }

    public function addToCart(Request $request, Product $product)
    {

        $cart_data = [
            'id' => $product->id,
            'name' => $product->name,
            'price' => $product->price,
            'qty' => $request->get('item_value') ?? 1,
            'options' => ['product_image' => asset($product->getSingleImage()), 'product_quantity' => $product->quantity]
        ];

        $base_remove_path =  url('/').'/shop/cart/item/';

        if (Cart::count() > 0){
            $cart_item = Cart::search(function ($cartItem, $rowId) use($product){
                return $cartItem->id === $product->id;
            });

            if(count($cart_item) > 0){
                foreach ($cart_item as $item){
                    if ($product->quantity > $item->qty){

                        Cart::add($cart_data);

                        $this->computeCoupon();

                        return response()->json([
                            'msg' => "$product->name added to cart",
                            'code' => 200,
                            'cart' => Cart::content(),
                            'cart_count' => Cart::count(),
                            'cart_total' => Cart::subtotal(),
                            'checkout' => route('website.checkout.index'),
                            'base_path' => $base_remove_path,

                        ]);
                    }

                    return $this->failResponse('Only '.$product->quantity.' are available in stock at the moment');

                }
            }

        }

        Cart::add($cart_data);

        $this->computeCoupon();

        return response()->json([
            'msg' => "$product->name added to cart",
            'code' => 200,
            'cart' => Cart::content(),
            'cart_count' => Cart::count(),
            'cart_total' => Cart::subtotal(),
            'checkout' => route('website.checkout.index'),
            'base_path' => $base_remove_path,
        ]);
    }


    public function removeFromCart($row)
    {
        $base_remove_path =  url('/').'/shop/cart/item/';

        $cart = Cart::get($row);

        $coupon = session()->get('checkout_data.coupon');

        $sub_total = Cart::subtotal(0, '', '') - $cart->price;

        if(!empty($coupon))
            $coupon_discount = $this->calculateDiscount($coupon->amount_type, $coupon->amount, $sub_total);


//        return session()->remove('checkout_data');

        Cart::remove($row);

        $checkout_amount = [
            'card' => Cart::content(),
            'total' => $coupon ? Cart::subtotal(0, '', '') - (Cart::subtotal(0, '', '') - $this->calculateDiscount($coupon->amount_type, $coupon->amount)) : Cart::subtotal(0, '', ''),
            'delivery' => session()->get('delivery_bill') ?? 0,
//            'sub_total' => $coupon ? (Cart::subtotal(0,'', '') - $cart->price) - $coupon : 0,

            'originalcart_price' => $cart->price,
            'sub_total' => $coupon ? Cart::subtotal(0, '', '') - $this->calculateDiscount($coupon->amount_type, $coupon->amount) : 0,
            'coupon' => session()->get('checkout_data.coupon')
        ];

//        return $checkout_amount;

        session()->put('checkout_data', $checkout_amount);


        return response()->json([
            'msg' => "Item removed from cart",
            'code' => 200,
            'cart' => Cart::content(),
            'cart_count' => Cart::count(),
            'cart_total' => Cart::subtotal(),
            'checkout' => route('website.checkout.index'),
            'base_path' => $base_remove_path,
        ]);
    }


    public function updateCart(Request $request)
    {
        $fields = $request->get('fields');

        foreach ($fields as $field){
            $cart = Cart::get($field['rowId']);

            if ($cart->options['product_quantity'] >= $field['form_value']){
                Cart::update($field['rowId'], ['qty' => $field['form_value']]);
            }else{
                return $this->failResponse('Available stock for '.$cart->name.' is less then the requested amount');
            }

        }

        $this->computeCoupon();

        Session::flash('success', 'Cart updated successfully');

        return response()->json([
            'code' => 200,
            'url' => route('website.cart.index')
        ]);
    }


    public function addCoupon(Request $request)
    {
        $coupon_code = $request->get('coupon');

        $validate = Validator::make($request->all(), ['coupon' => 'required']);

        if($validate->fails())
            return $this->failResponse($validate->errors()->first());

        $coupon = Coupon::query()->where('name', $coupon_code)->first();

        if (!empty($coupon) && $coupon->is_active = true){
            if (auth()->guard('web')->user()){

                $discount = $this->calculateDiscount($coupon->amount_type, $coupon->amount);

                $checkout_amount = [
                    'cart' => Cart::content(),
                    'total' => $discount,
                    'delivery' => session()->get('delivery_bill') ?? 0,
                    'sub_total' => Cart::subtotal(0,'', '') - $discount,
                    'coupon' => $coupon,
                ];

                session()->put('checkout_data', $checkout_amount);

                Session::flash('success', 'Coupon applied successfully');

                return response()->json([
                    'code' => 200,
                    $checkout_amount,
                    'msg' => 'Coupon applied successfully'
                ]);

//                return session()->get('checkout_amount');
            }

            return $this->failResponse('You must be logged in to apply coupon');
        }

        return $this->failResponse('Entered coupon code expired or does not exist');


    }

    public function calculateDiscount($discount_type, $discount_value, $session_sub_total = null)
    {
//        elling price = actual price - (actual price * (discount / 100)

        $delivery_bill = session()->get('delivery_bill') ?? 0;

//        if($session_sub_total != null){
//            $sub_total = $session_sub_total;
//        }else{
            $sub_total = Cart::subtotal(0,'', '');
//        }

        $sub_total = $delivery_bill + $sub_total;

        if ($discount_type === 'percentage') {
            $discount = $sub_total - ($sub_total * ($discount_value / 100));

        }else{
            $discount = $sub_total - $discount_value;
        }


        return $discount;

    }


    public function calculateShipping(Request $request)
    {
        $data = $request->all();

        $validate = Validator::make($data, [
            'region' => 'required',
            'town' => 'required'
        ]);
    }


}
