<?php

namespace App\Http\Controllers\Website;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Wishlist;
use Illuminate\Http\Request;

class WishlistController extends Controller
{
    public function __construct()
    {
        $this->middleware('web');
    }

    public function index()
    {
        $wishlist = Wishlist::query()->where('user_id', auth()->guard('web')->user()->id)->get();

        return view('website.wishlist.index', compact('wishlist'));
    }


    public function store(Product $product)
    {

        $user = auth()->guard('web')->user()->id;

        $check_wishlist = Wishlist::query()->where('user_id', $user)->where('product_id', $product->id)->first();

        if (empty($check_wishlist)){
            $wishlist = Wishlist::query()->create($this->dumpData($product->id));

            return $this->wishlistResponse("$product->name added to wishlist", $wishlist->count());
        }

        return $this->failResponse("$product->name already added to wishlist");


    }


    public function remove(Wishlist $wishlist)
    {
        $wishlist->delete();

        return back()->with('success', 'Wishlist successfully deleted');
    }


    public function dumpData($product)
    {
        return [
            'user_id' => auth()->guard('web')->user()->id,
            'product_id' => $product,
        ];
    }

    public function wishlistResponse($msg, $count)
    {
        return response()->json([
            'code' => 200,
            'msg' => $msg,
            'count' => $count
        ]);
    }
}
