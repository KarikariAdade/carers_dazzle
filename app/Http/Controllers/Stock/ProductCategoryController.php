<?php

namespace App\Http\Controllers\Stock;

use App\Http\Controllers\Controller;
use App\Models\ProductCategory;
use Illuminate\Http\Request;

class ProductCategoryController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        return view('stock.categories.index');
    }


    public function create()
    {
        return view('stock.categories.create');
    }


    public function store(Request $request)
    {
        return $request->all();
    }


    public function edit(ProductCategory $category)
    {
        return $category;
    }


    public function update(Request $request, ProductCategory $category)
    {
        return $category;
    }


    public function delete(ProductCategory $category)
    {
        return $category;
        $category->delete();

//        return route()
    }


}
