<?php

namespace App\Http\Controllers\Customers;

use App\DataTables\Customer\InvoiceDatatable;
use App\DataTables\Customer\OrdersDatatable;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Website\HomepageController;
use App\Models\Invoice;
use App\Models\Order;
use Barryvdh\DomPDF\Facade as PDF;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    private $pageItems;

    public function __construct()
    {
        $this->middleware('web');

        $this->pageItems = (new HomepageController())->pageDependencies();
    }


    public function index()
    {
        return view('customers.dashboard', ['pageItems' => $this->pageItems]);
    }


    public function orders(OrdersDatatable $datatable)
    {
        return $datatable->render('customers.orders.index', ['pageItems' => $this->pageItems]);
    }

    public function orderDetail(Order $order)
    {
        $order_items = json_decode($order->meta, true);

        return view('customers.orders.details', ['pageItems' => $this->pageItems, 'order' => $order, 'order_items' => $order_items]);
    }

    public function invoices(InvoiceDatatable $datatable)
    {
        return $datatable->render('customers.invoice.index', ['pageItems' => $this->pageItems]);
    }


    public function invoiceDetail(Invoice $invoice)
    {
        $invoice_items = json_decode($invoice->meta, true);

        return view('customers.invoice.detail', ['pageItems' => $this->pageItems, 'invoice' => $invoice, 'invoice_items' => $invoice_items]);
    }


    public function printInvoice(Invoice $invoice)
    {
        $invoice_items = json_decode($invoice->meta, true);

//        return view('customers.prints.invoice', ['invoice' => $invoice, 'invoice_items' => $invoice_items]);
        $file = PDF::loadView('customers.prints.invoice', ['invoice' => $invoice, 'invoice_items' => $invoice_items])->setPaper('A4');
        return $file->download($invoice->invoice_number.'.pdf');
    }


    public function accountDetails()
    {
        $pageItems = $this->pageItems;

        return view('customers.account.index', compact('pageItems'));
    }


    public function updateAccountDetails(Request $request)
    {
        return $request;
    }
}
