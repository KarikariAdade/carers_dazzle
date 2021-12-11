<?php

namespace App\Http\Controllers\Stock;

use App\DataTables\CouponDatatable;
use App\Http\Controllers\Controller;
use App\Models\Coupon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CouponsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(CouponDatatable $datatable)
    {
        return $datatable->render('stock.coupon.index');
    }


    public function store(Request $request)
    {
        $data = $request->all();

        $validate = Validator::make($data, $this->runValidation());

        if ($validate->fails()){
            return $this->failResponse($validate->errors()->first());
        }

        $coupon = Coupon::query()->create($this->dumpData($data));

        return $this->successResponse('Coupon: '.$coupon->name.' added successfully');


    }

    public function update(Request $request, Coupon $coupon)
    {
        $data = $request->all();

        $validate = Validator::make($data, $this->runValidation());

        if ($validate->fails()){
            return $this->failResponse($validate->errors()->first());
        }

        $coupon->update($this->dumpData($data));

        return $this->successResponse('Coupon updated successfully');
    }


    public function delete(Coupon $coupon)
    {
        $coupon->delete();


    }


    public function runValidation()
    {
        return [
            'name' => 'required|unique:coupons,name',
            'amount' => 'required',
            'amount_type' => 'required',
            'description' => 'nullable'
        ];
    }

    public function dumpData($data)
    {
        return [
            'name' => $data['name'],
            'amount' => $data['amount'],
            'amount_type' => $data['amount_type'],
            'description' => $data['description'],
        ];
    }
}
