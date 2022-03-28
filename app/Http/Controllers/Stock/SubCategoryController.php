<?php

namespace App\Http\Controllers\Stock;

use App\DataTables\SubCategoryDatatable;
use App\Http\Controllers\Controller;
use App\Models\ProductCategory;
use App\Models\SubCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use PhpOffice\PhpSpreadsheet\Calculation\Category;

class SubCategoryController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }


    public function index(SubCategoryDatatable $dataTable)
    {
        $categories = ProductCategory::query()->get();

        return $dataTable->render('admin.stock.sub_category.index', compact('categories'));
    }


    public function update(SubCategory $shelf, Request $request)
    {
        $data = $request->all();

        $validate = Validator::make($data, $this->validation());

        if ($validate->fails()){
            return $this->failResponse($validate->errors()->first());
        }

        $shelf->update($this->dumpData($data));

        return $this->successResponse('SubCategory updated successfully');
    }


    public function store(Request $request)
    {
        $data = $request->all();

        $validate = Validator::make($data, $this->validation());

        if ($validate->fails()){
            return $this->successResponse($validate->errors()->first());
        }

        SubCategory::query()->create($this->dumpData($data));

        return $this->successResponse('SubCategory added successfully');

    }


    public function delete(SubCategory $shelf)
    {
        $shelf->delete();

        return $this->successResponse('SubCategory successfully deleted');
    }

    public function validation()
    {
        return [
            'name' => 'required:unique:sub_category,name',
            'category' => 'required',
            'description' => 'nullable'
        ];
    }


    public function dumpData($data)
    {
        return [
            'name' => $data['name'],
            'category_id' => $data['category'],
            'description' => $data['description'],
        ];
    }
}
