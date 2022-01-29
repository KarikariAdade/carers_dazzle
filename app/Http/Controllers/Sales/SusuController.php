<?php

namespace App\Http\Controllers\Sales;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\User;
use Illuminate\Http\Request;

class SusuController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    public function index()
    {
        return view('admin.sales_management.susu.index');
    }


    public function create()
    {
        $customers = User::query()->get();

        return view('admin.sales_management.susu.create', compact('customers'));
    }


    public function store(Request $request)
    {
        return $request->all();
    }


    public function fetchProducts()
    {
        return Product::query()->get();
    }
}
