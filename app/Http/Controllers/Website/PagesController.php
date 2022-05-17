<?php

namespace App\Http\Controllers\Website;

use App\Http\Controllers\Controller;
use App\Models\Brands;
use App\Models\Product;
use App\Models\ProductCategory;
use App\Models\PromotionalBanner;
use Illuminate\Http\Request;

class PagesController extends Controller
{

    public function home()
    {
        $arrivals = Product::query()->orderBy('id', 'DESC')->skip(0)->take(10)->get();

        $most_viewed = Product::query()->orderBy('views', 'DESC')->skip(0)->take(4)->get();

        $best_selling = Product::query()->orderBy('orders', 'DESC')->skip(0)->take(4)->get();

        $promotional_banners = PromotionalBanner::query()->where('is_slider_featured', true)->where('is_active', true)->get();

//        return $promotional_banners;
        return view('home', compact('arrivals', 'most_viewed', 'best_selling', 'promotional_banners'));
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

    public function contact()
    {
        return view('website.contact.index');
    }

}
