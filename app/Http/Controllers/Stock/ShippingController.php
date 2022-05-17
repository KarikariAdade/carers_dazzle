<?php

namespace App\Http\Controllers\Stock;

use App\DataTables\ShippingDatatable;
use App\Http\Controllers\Controller;
use App\Models\Countries;
use App\Models\Shipping;
use App\Models\Towns;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class ShippingController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin')->except(['getTowns']);
    }


    public function index(ShippingDatatable $datatable)
    {
        $regions = Countries::query()->orderBy('name', 'ASC')->get();

        return $datatable->render('admin.stock.shipping.index', compact('regions'));
    }


    public function store(Request $request)
    {
        $data = $request->all();

        $validate = Validator::make($data, $this->validateFields());

        if ($validate->fails()){
            return $this->failResponse($validate->errors()->first());
        }

        DB::transaction(function () use ($data){
            if ($data['set_default'] === '1'){
                DB::table('shippings')->update(['is_default' => false]);
            }

            Shipping::query()->create($this->dumpData($data));
        });

        return $this->successResponse('Shipping Charge added successfully');

    }


    public function edit(Shipping $shipping)
    {
        $regions = Countries::query()->orderBy('name', 'ASC')->get();

        return view('admin.stock.shipping.edit', compact('shipping', 'regions'));
    }


    public function update(Request $request, Shipping $shipping)
    {
        $data = $request->all();

        $validate = Validator::make($data,[
            'region' => 'required',
            'town' => 'required',
            'amount' => 'required',
            'set_default' => 'nullable'
        ]);

        if ($validate->fails()){
            return $this->failResponse($validate->errors()->first());
        }

        DB::transaction(function () use ($data, $shipping){
            if ($data['set_default'] === '1'){
                DB::table('shippings')->update(['is_default' => false]);
            }

            $shipping->update($this->dumpData($data));
        });

        return $this->successResponse('Shipping Charge updated successfully');

    }


    public function delete(Shipping $shipping)
    {
        $shipping->delete();

        return $this->successResponse('Shipping Charge deleted successfully');
    }


    public function setDefault(Shipping $shipping)
    {

        DB::transaction(function () use ($shipping){
            DB::table('shippings')->update(['is_default' => false]);

            $shipping->update(['is_default' => true]);

        });

        return $this->successResponse('Shipping Charge successfully set as default');
    }

    public function getTowns(Request $request)
    {
        $towns = Towns::query()->where('country_id', $request->get('item'))->get();

        return $towns;
    }



    public function validateFields($town = null)
    {
        return [
            'region' => 'required',
            'town' => 'required|unique:shippings,town_id,'.$town,
            'amount' => 'required',
            'set_default' => 'nullable'
        ];

    }

    public function dumpData($data)
    {
        return [
            'region_id' => $data['region'],
            'town_id' => $data['town'],
            'amount' => $data['amount'],
            'is_default' => $data['set_default'] ?? false
        ];
    }



}
