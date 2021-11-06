<?php

namespace App\Http\Controllers\Stock;

use App\DataTables\ProductCategoryDatatable;
use App\Http\Controllers\Controller;
use App\Models\ProductCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ProductCategoryController extends Controller
{
//    public function __construct()
//    {
//        $this->middleware('auth');
//    }

    public function index(ProductCategoryDatatable $datatable)
    {
        return $datatable->render('stock.categories.index');
    }


    public function create()
    {
        return view('stock.categories.create');
    }


    public function store(Request $request)
    {
        $data = $request->all();

        $validate = Validator::make($data, [
            'name' => 'required',
            'description' => 'nullable'
        ]);

        if ($validate->fails()){
            return $this->failResponse($validate->errors()->first());
        }

        ProductCategory::query()->create([
            'name' => $data['name'],
            'description' => $data['description']
        ]);

        return $this->successResponse('Product Category added successfully');
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
