<?php

namespace App\Http\Controllers\Website;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\ProductCategory;
use Illuminate\Http\Request;

class PagesController extends Controller
{
    public function shop()
    {
        return view('website.shop.index');
    }


    public function category($random, ProductCategory $category, $name)
    {

        $products = Product::query()->where('category_id', $category->id)->paginate(16);

        return view('website.category.index', compact('products', 'category'));
    }

    public function brand()
    {
        return view('website.brand.index');
    }

    public function productDetail(Product $product, $name, $hash)
    {
        return view('website.shop.detail', compact('product'));
    }
}
