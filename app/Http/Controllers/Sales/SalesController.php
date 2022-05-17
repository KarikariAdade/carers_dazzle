<?php

namespace App\Http\Controllers\Sales;

use App\DataTables\DailySalesDatatable;
use App\DataTables\SalesReportDataTable;
use App\DataTables\PaymentDataTable;
use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\Payment;
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


    public function report(SalesReportDataTable $datatable)
    {
        $pageData = $this->getAllSales();

        return $datatable->render('admin.sales_management.sales_report.index', compact('pageData'));
    }

    public function payment( PaymentDataTable $datatable)
    {
        $pageData = $this->paymentStatus();

        return $datatable->render('admin.sales_management.payment.index', compact('pageData'));
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

    public function getAllSales()
    {
        $daily_orders = Order::query()->selectRaw('sum(net_total) as net_total, count(*) as count')->get();

        $paid_orders = Order::query()->selectRaw('sum(net_total) as net_total, count(*) as count')->where('order_status', '=', 'Paid')->get();

        $unpaid_orders = Order::query()->selectRaw('sum(net_total) as net_total, count(*) as count')->where('order_status', '=', 'Pending Payment')->get();

        return [
            'daily_orders' => $daily_orders,
            'paid_orders' => $paid_orders,
            'unpaid_orders' => $unpaid_orders
        ];
    }
    public function paymentStatus()
    {
        $daily_orders = Payment::query()->selectRaw('sum(amount) as net_total, count(*) as count')->get();

        $paid_orders = Payment::query()->selectRaw('sum(amount) as net_total, count(*) as count')->where('status', '=', 'success')->get();

        $unpaid_orders = Payment::query()->selectRaw('sum(amount) as net_total, count(*) as count')->where('status', '=', 'failed')->get();

        return [
            'daily_orders' => $daily_orders,
            'paid_orders' => $paid_orders,
            'unpaid_orders' => $unpaid_orders
        ];
    }
}
