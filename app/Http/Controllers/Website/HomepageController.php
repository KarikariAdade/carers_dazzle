<?php

namespace App\Http\Controllers\Website;

use App\Http\Controllers\Controller;
use App\Models\Brands;
use App\Models\Product;
use App\Models\ProductCategory;
use Illuminate\Http\Request;

class HomepageController extends Controller
{
    public function index()
    {
        $pageItems = $this->pageDependencies();

        return view('website.index', compact('pageItems'));
    }


    public function brand($brand)
    {
        $brand = str_replace('_', ' ', $brand);

        $brands = Brands::query()->where('name', 'LIKE', $brand)->first();

        return view('website.brands', ['brands' => $brands, 'pageItems' => $this->pageDependencies()]);
    }


    public function categories($category)
    {
        $category = str_replace('_', ' ', $category);

        $categories = ProductCategory::query()->where('name', 'LIKE', $category)->first();

        return view('website.categories', ['categories' => $categories, 'pageItems' => $this->pageDependencies()]);
    }


    public function shops()
    {
        $products = Product::query()->orderBy('id', 'DESC')->paginate(16);

        return view('website.shop', ['products' => $products, 'pageItems' => $this->pageDependencies()]);
    }

    public function pageDependencies()
    {
        $categories = ProductCategory::query()->get();

        $brands = Brands::query()->get();

        return [
            'categories' => $categories,
            'brands' => $brands
        ];
    }
}
