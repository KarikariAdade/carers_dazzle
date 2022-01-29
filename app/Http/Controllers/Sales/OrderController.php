<?php

namespace App\Http\Controllers\Sales;

use App\DataTables\OrdersDatatable;
use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    public function index(OrdersDatatable $datatable)
    {
        return $datatable->render('admin.sales_management.orders.index');
    }

    public function details(Order $order)
    {
        $order_items = json_decode($order->meta, true);

        return view('admin.sales_management.orders.details', compact('order', 'order_items'));
    }



}
