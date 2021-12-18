<?php

namespace App\Http\Controllers\Stock;

use App\DataTables\CustomersDatatable;
use App\Http\Controllers\Controller;
use App\Models\Customer;
use Illuminate\Http\Request;

class CustomersController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(CustomersDatatable $datatable)
    {
        return $datatable->render('sales_management.customers.index');
    }

    public function store(Request $request)
    {
        return $request->all();
    }


    public function update(Request $request, Customer $customer)
    {
        return $customer;
    }


    public function delete(Customer $customer)
    {
        return $customer;
    }


}
