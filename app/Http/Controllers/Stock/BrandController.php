<?php

namespace App\Http\Controllers\Stock;

use App\DataTables\BrandDataTable;
use App\Http\Controllers\Controller;
use App\Models\Brands;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class BrandController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }


    public function index(BrandDataTable $dataTable)
    {
        return $dataTable->render('admin.stock.brands.index');
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

        Brands::query()->create([
            'name' => $data['name'],
            'description' => $data['description']
        ]);

        return $this->successResponse('Brand added successfully');
    }


    public function update(Request $request, Brands $brands)
    {
        $data = $request->all();


        $validate = Validator::make($data, [
            'name' => 'required',
            'description' => 'nullable'
        ]);

        if ($validate->fails()){
            return $this->failResponse($validate->errors()->first());
        }

        $brands->update([
            'name' => $data['name'],
            'description' => $data['description']
        ]);

        return $this->successResponse('Brand updated successfully');
    }


    public function delete(Brands $brands)
    {
        $brands->delete();

        return $this->successResponse('Brand deleted successfully');
    }
}
