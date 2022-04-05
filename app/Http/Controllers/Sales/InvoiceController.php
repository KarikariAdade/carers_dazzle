<?php

namespace App\Http\Controllers\Sales;

use App\DataTables\InvoiceDatatable;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Website\CheckoutController;
use App\Models\Invoice;
use App\Models\InvoiceItems;
use App\Models\Order;
use App\Models\Product;
use App\Models\User;

use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use PHPUnit\Util\Exception;

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

        $data = $request->all();

        $validate = Validator::make($data, $this->validateFields());

        if ($validate->fails()){
            return $this->failResponse($validate->errors()->first());
        }

        foreach ($data['product_rows'] as $row){

            $name = $this->getProductName($row['selected_product_id'])->name;

            $image = $this->getProductName($row['selected_product_id'])->getSingleImage();

            Cart::add([
                'id' => $row['selected_product_id'],
                'name' => $name,
                'price' => $row['price'],
                'qty' => $row['quantity'] ?? 1,
                'options' => ['product_image' => $image, 'product_quantity' => $row['quantity']]
            ]);

        }

        DB::beginTransaction();

        try{

            $invoice = Invoice::query()->create($this->generateInvoice($data));

            $order = Order::query()->create($this->generateOrder($data));

            $invoice->update(['order_id' => $order->id]);

            $order->update(['invoice_id' => $invoice->id]);

            $data['invoice_id'] = $invoice->id;

            foreach ($data['product_rows'] as $row){

                InvoiceItems::query()->create($this->generateInvoiceItems($data['invoice_id'], $row));
            }

            DB::commit();

            Cart::destroy();

            session()->flash('success', 'Invoice added successfully');

            return $this->successResponse('success');

        } catch(\Exception $exception){
            DB::rollback();

            Log::error($exception->getMessage());

            return $this->failResponse('Invoice could not be added. Kindly contact admin');

        }

    }


    public function details(Invoice $invoice)
    {
        $invoice_items = json_decode($invoice->meta, true);

        return view('admin.sales_management.invoice.show', compact('invoice', 'invoice_items'));
    }


    public function fetchInvoiceItems(Invoice $invoice)
    {
        return InvoiceItems::query()->where('invoice_id', $invoice->id)->get();
    }

    public function edit(Invoice $invoice)
    {

        $customers = User::query()->orderBy('id', 'DESC')->get();

        return view('admin.sales_management.invoice.edit', compact('invoice', 'customers'));
    }


    public function update(Request $request, Invoice $invoice)
    {
        $data = $request->all();

        $validate = Validator::make($data, $this->validateFields());

        if ($validate->fails()){
            return $this->failResponse($validate->errors()->first());
        }

        foreach ($data['product_rows'] as $row){

            $name = $this->getProductName($row['selected_product_id'])->name;

            $image = $this->getProductName($row['selected_product_id'])->getSingleImage();

            Cart::add([
                'id' => $row['selected_product_id'],
                'name' => $name,
                'price' => $row['price'],
                'qty' => $row['quantity'] ?? 1,
                'options' => ['product_image' => $image, 'product_quantity' => $row['quantity']]
            ]);

        }

        DB::beginTransaction();

        try{

            $data['invoice_number'] = $invoice->invoice_number;

            $data['order_id'] = $invoice->getOrder->order_id;

            $invoice->update($this->generateInvoice($data));

            $invoice->getOrder->update($this->generateOrder($data));

            $invoice->update(['order_id' => $invoice->getOrder->id]);

            $invoice->getOrder->update(['invoice_id' => $invoice->id]);

            $data['invoice_id'] = $invoice->id;


            DB::table('invoice_items')->where('invoice_id', $invoice->id)->delete();

            foreach ($data['product_rows'] as $row){

                InvoiceItems::query()->create($this->generateInvoiceItems($data['invoice_id'], $row));
            }

            DB::commit();

            Cart::destroy();

            session()->flash('success', 'Invoice updated successfully');

            return $this->successResponse('success');

        } catch(\Exception $exception){
            DB::rollback();

            Log::error($exception->getMessage().$exception->getLine());

            return $this->failResponse('Invoice could not be added. Kindly contact admin');

        }
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




    public function generateInvoice($data)
    {
        return [
            'user_id' => $data['customer'],
            'meta' =>  Cart::content(),
            'payment_type' => $data['payment_type'] ?? 'N/A',
            'payment_status' => $data['payment_status'],
            'invoice_number' => $data['invoice_number'] ?? (new CheckoutController())->generateOrderCode('invoice'),
            'is_admin_created' => true,
            'discount_type' => $data['discount_type'],
            'discount' => $data['discount_amount'],
            'shipping' => $data['shipping_fee']
        ];
    }


    public function generateOrder($data)
    {
        return [
            'user_id' => $data['customer'],
            'meta' => Cart::content(),
            'order_id' => $data['order_id'] ?? (new CheckoutController())->generateOrderCode('order'),
            'sub_total' => $data['all_sub_total'],
            'discount' => $data['discount_total'],
            'shipping' => $data['shipping'],
            'net_total' => $data['all_net'],
            'payment_type' => $data['payment_type'] ?? 'N/A',
            'order_status' => $data['payment_status']
        ];
    }



    public function generateInvoiceItems($invoice, $data)
    {
        return [
            'invoice_id' => $invoice,
            'product_id' => $data['selected_product_id'],
            'row_sub_total' => $data['row_sub_total'],
            'quantity' => $data['quantity'],
            'price' => $data['price'],
            'description' => $data['description'],
            'max_quantity' => $data['max_quantity'] ?? null
        ];
    }

    public function getProductName($id)
    {
        return Product::query()->where('id', $id)->first() ?? 'N/A';
    }

    public function validateFields()
    {
        return [
            'customer' => 'required',
            'shipping_fee' => 'required',
            'discount_type' => 'required',
            'discount_amount' => 'required',
            'all_sub_total' => 'required',
            'all_net' => 'required',
            'shipping' => 'required',
            'discount_total' => 'required',
        ];
    }

}
