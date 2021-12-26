<?php

namespace App\Http\Controllers\Website;

use App\Http\Controllers\Controller;
use App\Models\Brands;
use App\Models\ProductCategory;
use Illuminate\Http\Request;

class HomepageController extends Controller
{
    public function index()
    {
        $categories = ProductCategory::query()->get();

        $brands = Brands::query()->get();

        return view('website.index', compact('categories', 'brands'));
    }
}
