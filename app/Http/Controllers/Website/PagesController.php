<?php

namespace App\Http\Controllers\Website;

use App\Http\Controllers\Controller;
use App\Models\Brands;
use App\Models\Product;
use App\Models\ProductCategory;
use Illuminate\Http\Request;

class PagesController extends Controller
{

    public function home()
    {
        $arrivals = Product::query()->orderBy('id', 'DESC')->skip(0)->take(10)->get();

        return view('home', compact('arrivals'));
    }

    public function shop()
    {
        $products = Product::query()->orderBy('id', 'DESC')->paginate(16);

        return view('website.shop.index', compact('products'));
    }


    public function category($random, ProductCategory $category, $name)
    {

        $products = Product::query()->where('category_id', $category->id)->paginate(16);

        return view('website.category.index', compact('products', 'category'));
    }


    public function brand($random, Brands $brand, $name)
    {
        $products = Product::query()->where('brand_id', $brand->id)->paginate(16);

        return view('website.brand.index', compact('products', 'brand'));
    }


    public function productDetail(Product $product, $name, $hash)
    {
        $product->update(['views' => $product->views + 1]);

        $rating = number_format($product->averageRating, 0);
//        return $rating;

        return view('website.shop.detail', compact('product', 'rating'));
    }
}
