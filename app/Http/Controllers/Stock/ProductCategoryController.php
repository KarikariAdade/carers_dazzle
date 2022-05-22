<?php

namespace App\Http\Controllers\Stock;

use App\DataTables\ProductCategoryDatatable;
use App\Http\Controllers\Controller;
use App\Models\ProductCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class ProductCategoryController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    public function index(ProductCategoryDatatable $datatable)
    {
        return $datatable->render('admin.stock.categories.index');
    }


    public function store(Request $request)
    {
        $data = $request->all();

        $image = $request->file('image');

        $validate = Validator::make($data, [
            'name' => 'required',
            'description' => 'nullable',
            'image' => 'nullable'
        ]);

        if ($validate->fails()){
            return $this->failResponse($validate->errors()->first());
        }

        if(!empty($image)) {

            $data['image'] = $this->performUpload($request->file('image'), 'images/');
        }

       $category = ProductCategory::query()->create([
            'name' => $data['name'],
            'description' => $data['description'],
            'featured_category' => $data['featured_category'],
            'image' => $data['image'],
        ]);


        return $this->successResponse('Product Category added successfully');
    }



    public function update(Request $request, ProductCategory $category)
    {
        $data = $request->all();

        $image = $request->file('image');


        $validate = Validator::make($data, [
            'name' => 'required',
            'description' => 'nullable'
        ]);

        if ($validate->fails()){
            return $this->failResponse($validate->errors()->first());
        }

        if(!empty($image)) {

            $data['image'] = $this->performUpload($request->file('image'), 'images/');
        }else{

            $data['image'] = $category->image;

        }

        $category->update([
            'name' => $data['name'],
            'description' => $data['description'],
            'featured_category' => $data['featured_category'],
            'image' => $data['image'],
        ]);


        return $this->successResponse('Product Category updated successfully');
    }


    public function delete(ProductCategory $category)
    {
        $category->delete();

        return $this->successResponse('Category successfully deleted');

    }


    public function performUpload($file)
    {

        # Add random string to filename
        $file_name = time(). '' . $file->getClientOriginalName();

        # Set file path

        $path = "product_image/";

        # Get absolute path for file storage
        $abs_path = storage_path("app/public/$path");

//        Storage::put($abs_path, $file_name);
        $file->move($abs_path, $file_name);

        return "storage/$path" . $file_name;
    }


}
