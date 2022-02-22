<?php

namespace App\Http\Controllers\Sales;

use App\DataTables\InvoiceDatatable;
use App\Http\Controllers\Controller;
use App\Models\Invoice;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

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
        $customers = User::query()->orderBy('id', 'DESC')->get();

        return view('admin.sales_management.invoice.create', compact('customers'));
    }


    public function store(Request $request)
    {
        return $request->all();
    }


    public function details(Invoice $invoice)
    {
        $invoice_items = json_decode($invoice->meta, true);

        return view('admin.sales_management.invoice.show', compact('invoice', 'invoice_items'));
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

    public function verifyPayment(Request $request, Invoice $invoice)
    {
        $order_trans_id = null;

        $transaction_id = $request->get('transaction_id');

        if (empty($transaction_id)) {

            return $this->failResponse("Transaction ID field should not be empty");

        }

        if (!empty($invoice->getOrder)){

            $order_trans_id = $invoice->getOrder->trans_code;

        }

        if(empty($order_trans_id)){

            $new_trans_code = random_int(111111, 999999);

            $sms_data = [
                'phone' => auth()->guard('admin')->user()->phone,
                'msg' => "Hello ".auth()->guard('admin')->user()->name.", trans code for invoice (".$invoice->invoice_number.") is ".$new_trans_code,
            ];

            $this->sendSMS($sms_data);

            $invoice->getOrder->update(['trans_code' => $new_trans_code]);

            return $this->successResponse("A new Transaction Code has been sent to ".auth()->guard('admin')->user()->phone." Kindly use it to verify payment");
        }


        if ($invoice->getOrder->trans_code === $transaction_id){

            $invoice->update(['payment_status' => "Paid"]);

            $invoice->getOrder->update(['order_status' => "Paid"]);

            return $this->successResponse("Payment verified successfully");

        }


        return $this->failResponse("Invalid Transaction Code");


    }





    public function sendSMS($data)
    {
        $msg = $data['msg'];
        $fields = [
            'sender' => env('FAYASMS_SENDER'),
            'message' => $msg,
            'recipients' => [
                $data['phone']
            ]
        ];

        $url = 'https://devapi.fayasms.com/messages';

        $ch = curl_init();
        $headers = array();
        $headers[] = "Content-Type: application/json";
        $headers[] = 'fayasms-developer: 17596282.BD8nlMwlSlVUkXBvAa6uzLatjqBSDJpu';
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($fields));
        $result = curl_exec($ch);
        $result = json_decode($result, TRUE);
        curl_close($ch);

        Log::info($result);

        $data['type'] = "Order SMS";


        $this->logSMSData($data,$result);

    }
}
