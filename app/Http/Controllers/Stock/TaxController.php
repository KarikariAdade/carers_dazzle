<?php

namespace App\Http\Controllers\Stock;

use App\DataTables\TaxDatatable;
use App\Http\Controllers\Controller;
use App\Models\Taxes;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class TaxController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    public function index(TaxDatatable $datatable)
    {
        return $datatable->render('stock.tax.index');
    }


    public function store(Request $request)
    {
        $data = $request->all();

        $validate = Validator::make($data, $this->validateData());

        if($validate->fails()){
            return $this->failResponse($validate->errors()->first());
        }

        $tax = Taxes::query()->create($this->dumpData($data));

        return $this->successResponse('Tax: '.$tax->name.' added successfully');
    }


    public function update(Request $request, Taxes $tax)
    {
        $data = $request->all();

        $validate = Validator::make($data, $this->validateData($tax->id));

        if($validate->fails()){
            return $this->failResponse($validate->errors()->first());
        }

        $tax->update($this->dumpData($data));

        return $this->successResponse('Tax: '.$tax->name.' updated successfully');
    }


    public function delete(Taxes $tax)
    {
        $tax->delete();

        return $this->successResponse('Tax deleted successfully');
    }


    public function validateData($tax = null)
    {
        return [
            'name' => 'required|unique:taxes,name,'.$tax,
            'amount' => 'required',
            'description' => 'nullable'
        ];
    }

    public function dumpData($data)
    {
        return [
            'name' => $data['name'],
            'amount' => $data['amount'],
            'description' => $data['description']
        ];
    }
}
