<?php

namespace App\Http\Controllers\Sales;

use App\DataTables\InvoiceDatatable;
use App\Http\Controllers\Controller;
use App\Models\Invoice;
use Illuminate\Http\Request;

class InvoiceController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }


    public function index(InvoiceDatatable $datatable)
    {
        return $datatable->render('admin.sales_management.invoice.index');
    }


    public function create()
    {
        return view('admin.sales_management.invoice.create');
    }


    public function store(Request $request)
    {
        return $request->all();
    }


    public function details(Invoice $invoice)
    {
        return view('admin.sales_management.invoice.show', compact($invoice));
    }

    public function edit(Invoice $invoice)
    {
        return view('admin.sales_management.invoice.edit', compact('invoice'));
    }


    public function update(Request $request, Invoice $invoice)
    {
        return $request->all();
    }


    public function delete(Invoice $invoice)
    {
        return $invoice;
    }
}
