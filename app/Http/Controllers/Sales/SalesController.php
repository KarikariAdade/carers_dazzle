<?php

namespace App\Http\Controllers\Sales;

use App\DataTables\DailySalesDatatable;
use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;

class SalesController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    public function index(DailySalesDatatable $datatable)
    {
        $pageData = $this->getSales();

        return $datatable->render('admin.sales_management.daily_sales.index', compact('pageData'));
    }


    public function getSales()
    {
        $daily_orders = Order::query()->whereDate('created_at', date('Y-m-d'))->selectRaw('sum(net_total) as net_total, count(*) as count')->get();

        $paid_orders = Order::query()->whereDate('created_at', date('Y-m-d'))->selectRaw('sum(net_total) as net_total, count(*) as count')->where('order_status', '=', 'Paid')->get();

        $unpaid_orders = Order::query()->whereDate('created_at', date('Y-m-d'))->selectRaw('sum(net_total) as net_total, count(*) as count')->where('order_status', '=', 'Pending Payment')->get();

        return [
            'daily_orders' => $daily_orders,
            'paid_orders' => $paid_orders,
            'unpaid_orders' => $unpaid_orders
        ];
    }
}
