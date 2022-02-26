<?php

namespace App\Http\Controllers\Sales;

use App\DataTables\SusuDatatable;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Website\CheckoutController;
use App\Models\Product;
use App\Models\Susu;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;

class SusuController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    public function index(SusuDatatable $datatable)
    {
        return $datatable->render('admin.sales_management.susu.index');
    }


    public function create()
    {
        $customers = User::query()->get();

        return view('admin.sales_management.susu.create', compact('customers'));
    }


    public function store(Request $request)
    {
//        customer
//shipping_fee
//discount_type
//discount_amount
//payment_status
//payment_interval
//initial_amount
//remarks
//all_sub_total
//all_net
//shipping
//discount_total
        return $request->all();
    }


    public function fetchProducts()
    {
        return Product::query()->get();
    }

    public function edit(Susu $susu)
    {
        return $susu;
    }


    public function update(Request $request, Susu $susu)
    {
        return $request->all();
    }


    public function dumpSusuItems($data)
    {

//payment_status

        return [
            'user_id' => $data['customer'],
            'susu_number' => (new CheckoutController())->generateOrderCode('susu'),
            'shipping' => $data['shipping'],
            'discount_type' => $data['discount_type'],
            'discount_amount' => $data['discount_amount'],
            'discount_total' => $data['discount_total'],
            'sub_total' => $data['all_sub_total'],
            'net_total' => $data['all_net'],
            'remarks' => $data['remarks'],
            'amount_paid' => $data['initial_amount'],
            'payment_interval' => $data['payment_interval'],
            'expected_full_payment' => $data[''],
        ];
    }


    public function getExpectedDate($data)
    {
        $interval = $data['payment_interval'];

        $net_total = $data['all_net'];

        $initial_payment = $data['initial_amount'];

        $date = Carbon::now();

        $estimated_payment = $net_total / $initial_payment;

        return $estimated_payment;

//        Daily
//Weekly
//Monthly
    }
}
