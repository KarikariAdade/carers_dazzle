<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\User;
use Illuminate\Http\Request;
use App\Models\Order;
use App\DataTables\DashboardOrdersDataTable;



class AdminDashboardController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    public function index(DashboardOrdersDataTable $dataTable)
    {
        $customers = User::all()->count();

        $revenue = Order::all()->sum('net_total');


        return $dataTable->render('admin.dashboard', compact('customers', 'revenue'));
    }

    public function updatePhone(Request $request)
    {
        $phone = $request->get('phone');

        if (empty($phone)){
            return $this->failResponse("Phone Number field should not be empty");
        }

        if (auth()->guard('admin')->user()->updatePhone($phone)){
            return $this->successResponse("Phone Number updated successfully");
        }

        return $this->failResponse("Phone Number could not be updated");
    }
}
