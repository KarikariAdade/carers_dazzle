<?php

namespace App\Http\Controllers\Website;

use App\Http\Controllers\Controller;
use App\Models\Brands;
use App\Models\Product;
use App\Models\ProductCategory;
use App\Models\PromotionalBanner;
use App\Models\SubCategory;
use Illuminate\Http\Request;

class HomepageController extends Controller
{
    public function index()
    {
        $pageItems = $this->pageDependencies();

        $featured_products = Product::query()->where('is_featured', true)->inRandomOrder()->take(10)->get();

        $hot_deals = Product::query()->where('is_hot_deal', true)->get();

        $latest_products = Product::query()->orderBy('id', 'DESC')->take(10)->get();

        return view('website.index', compact('pageItems', 'featured_products', 'hot_deals', 'latest_products'));
    }


    public function brand($brand)
    {
        $brand = str_replace('_', ' ', $brand);

        $brands = Brands::query()->where('name', 'LIKE', $brand)->first();

        $products = Product::query()->where('brand_id', $brands->id)->orderBy('id', 'DESC')->paginate(1);

        return view('website.brands', ['brands' => $brands, 'pageItems' => $this->pageDependencies(), 'products' => $products]);
    }


    public function categories(Request $request, $category)
    {

        if ($request->get('sub')){

            $category = str_replace('_', ' ', $category);

            $categories = SubCategory::query()->where('name', 'LIKE', $category)->first();

            $products = Product::query()->where('shelf_id', $categories->id)->orderBy('id', 'DESC')->paginate(14);
        }else{
            $category = str_replace('_', ' ', $category);

            $categories = ProductCategory::query()->where('name', 'LIKE', $category)->first();

            $products = Product::query()->where('category_id', $categories->id)->orderBy('id', 'DESC')->paginate(14);
        }


        return view('website.categories', [
            'categories' => $categories,
            'pageItems' => $this->pageDependencies(),
            'products' => $products,
        ]);
    }


    public function shops()
    {
        $products = Product::query()->orderBy('id', 'DESC')->paginate(16);


        return view('website.shop.shop', ['products' => $products, 'pageItems' => $this->pageDependencies()]);
    }


    public function shopDetail(Product $product, $name, $hash)
    {
        $hot_deals = Product::query()->where('is_hot_deal', true)->get();

        $featured_products = Product::query()->where('is_featured', true)->inRandomOrder()->take(10)->get();


        return view('website.shop.product_detail', [
            'product' => $product,
            'pageItems' => $this->pageDependencies(),
            'hot_deals' => $hot_deals,
            'featured_products' => $featured_products
        ]);

    }

    public function pageDependencies()
    {
        $categories = ProductCategory::query()->get();

        $brands = Brands::query()->get();

        $slider_featured_banners = PromotionalBanner::query()->where('is_slider_featured', true)->get();

        return [
            'categories' => $categories,
            'brands' => $brands,
            'slider_featured_banners' => $slider_featured_banners
        ];
    }
}
