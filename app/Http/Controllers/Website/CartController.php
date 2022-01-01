<?php

namespace App\Http\Controllers\Website;

use App\Http\Controllers\Controller;
use App\Models\Coupon;
use App\Models\Product;
use App\Models\Regions;
use App\Models\Shipping;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
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

        Cart::remove($row);


        if (Cart::count() <= 0){
            session()->remove('delivery_bill');
            session()->remove('checkout_data');
        }
        $this->computeCoupon();


//        $checkout_amount = [
//            'card' => Cart::content(),
//            'total' => $coupon ? Cart::subtotal(0, '', '') - (Cart::subtotal(0, '', '') - $this->calculateDiscount($coupon->amount_type, $coupon->amount)) : Cart::subtotal(0, '', ''),
//            'delivery' => session()->get('delivery_bill.amount') ?? 0,
////            'sub_total' => $coupon ? (Cart::subtotal(0,'', '') - $cart->price) - $coupon : 0,
//
//            'originalcart_price' => $cart->price,
//            'sub_total' => $coupon ? Cart::subtotal(0, '', '') - $this->calculateDiscount($coupon->amount_type, $coupon->amount) : 0,
//            'coupon' => session()->get('checkout_data.coupon')
//        ];
//
////        return $checkout_amount;
//
//        session()->put('checkout_data', $checkout_amount);


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
                    'delivery' => session()->get('delivery_bill.amount') ?? 0,
                    'sub_total' => Cart::subtotal(0,'', '') - $discount,
                    'coupon' => $coupon,
                ];

                session()->put('checkout_data', $checkout_amount);

                $this->computeCoupon();

                Session::flash('success', 'Coupon applied successfully');

                return response()->json([
                    'code' => 200,
                    session()->get('checkout_data'),
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

        $delivery_bill = session()->get('delivery_bill.amount') ?? 0;

        Log::info('DeliveryBill from calculate discount: '.$delivery_bill);
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

        if($validate->fails()){
            return $this->failResponse($validate->errors()->first());
        }

        $shipping = Shipping::query()->where('region_id', $data['region']);

        if ($shipping->get()->count() > 0){
            $town = $shipping->where('town_id', $data['town']);

            if ($town->count() > 0){
                $town = $town->first();

                return $this->addShippingData($data, $town->amount);

            }

            $shipping = Shipping::query()->where('region_id', $data['region'])->get();

            return $this->addShippingData($data, $shipping->amount);

        }

        $default = Shipping::query()->where('is_default', true)->first();

        $default = $default->amount ?? 0;

        return $this->addShippingData($data, $default);
    }


    public function addShippingData($data, $amount)
    {

        $shipping_data = [
            'shipping' => $data,
        ];

        $shipping_data['amount'] = $amount;

        session()->put('delivery_bill', $shipping_data);

        $this->computeCoupon();

        Log::info(session()->get('checkout_data'));

        Session::flash('success', 'Shipping address added');

        return $this->successResponse('Shipping address added');
    }



    public function clearCart()
    {
        Cart::destroy();

        return back()->with('success', 'Cart successfully cleared');
    }



    public function computeCoupon()
    {
        $coupon = session()->get('checkout_data.coupon');

        $delivery_amount = session()->get('delivery_bill.amount') ?? 0;


        if(!empty($coupon))
            $coupon_discount = $this->calculateDiscount($coupon->amount_type, $coupon->amount, Cart::subtotal(0, '', ''));

        $amount_wthout_coupon = Cart::subtotal(0, '', '') + $delivery_amount;

        Log::info('Amount without coupon: '.$amount_wthout_coupon);

        $checkout_amount = [
            'card' => Cart::content(),
            'total' => $coupon ? Cart::subtotal(0, '', '') - (Cart::subtotal(0, '', '') - $this->calculateDiscount($coupon->amount_type, $coupon->amount)) : $amount_wthout_coupon,
            'delivery' => Cart::count() > 0 && session()->get('delivery_bill.amount') ? session()->get('delivery_bill.amount') : 0,
//            'sub_total' => $coupon ? (Cart::subtotal(0,'', '') - $cart->price) - $coupon : 0,

//            'originalcart_price' => $cart->price,
            'sub_total' => $coupon ? $amount_wthout_coupon - $this->calculateDiscount($coupon->amount_type, $coupon->amount) : 0,
            'coupon' => session()->get('checkout_data.coupon')
        ];


        session()->put('checkout_data', $checkout_amount);
    }


}
