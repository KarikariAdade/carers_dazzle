<?php

namespace App\Http\Controllers\Website;

use App\Helpers\ShopHelper;
use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\Product;
use Illuminate\Http\Request;

class FilterController extends Controller
{
    private $shop_helper;

    public function __construct()
    {
        $this->shop_helper = new ShopHelper();
    }


    public function index()
    {
        $filter = '';

        if (request()->has('sort')){

            $sort = request()->get('sort');

            if ($sort === 'popularity'){

                $filter = 'Filter By Popularity';

                $products = Product::query()->where('is_active', true)->orderByDesc('orders')->paginate(12);

            }

            if ($sort === 'rating'){

                $products = Product::query()->with('getReviews')->where('is_active', true)->paginate(12);

                $products = $products->filter(function($product){
                    return $product->getReviews->avg('rating') >3 ;
                });

                $filter = 'Filter By Top Rated';


            }

            if ($sort === 'date'){

                $products = Product::query()->where('is_active', true)->orderByDesc('id')->paginate(12);

                $filter = 'Filter By Most Recent';

            }

        }elseif (request()->has('keyword')){
            $keywords = request()->get('keyword');

            if (isset($keywords)){

                $products = Product::query()
                    ->where('name', 'LIKE', "%$keywords%")
                    ->orWhere('description', 'LIKE', "%$keywords%")->paginate(1);



//                $products = Product::query()
//                    ->where('name', 'LIKE', "%$keywords%")
//                    ->orWhere('description', 'LIKE', "%$keywords%")->get()
//                    ->map(function ($row) use ($keywords) {
//                        $row->name = preg_replace('/(' . $keywords . ')/i', "<b>$1</b>", $row->name);
//                        return $row;
//                    });

                $filter = 'Filter by keywords: '.$keywords;

            }else{
                return back();
            }


        }


        return view('website.filter.index', compact('products', 'filter'));
//
//
//        return 'no sorting';
    }
}
