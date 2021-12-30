<?php

namespace App\Http\Controllers\Website;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Http\Request;

class CartController extends Controller
{
    public function index()
    {
        return Cart::content();
        return view('website.cart.index', ['pageItems' => $this->pageDependencies()]);
    }

    public function addToCart(Request $request, Product $product)
    {

        $cart_data = [
            'id' => $product->id,
            'name' => $product->name,
            'price' => $product->price,
            'qty' => $request->get('item_value') ?? 1,
            'options' => ['product_image' => asset($product->getSingleImage())]
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

        Cart::remove($row);

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


}
