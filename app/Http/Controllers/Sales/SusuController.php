<?php

namespace App\Http\Controllers\Sales;

use App\DataTables\SusuDatatable;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Website\CheckoutController;
use App\Models\Invoice;
use App\Models\InvoiceItems;
use App\Models\Order;
use App\Models\Product;
use App\Models\Susu;
use App\Models\SusuItem;
use App\Models\User;
use Carbon\Carbon;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class SusuController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    public function index(SusuDatatable $datatable)
    {
        return $datatable->render('admin.sales_management.susu.index');
    }


    public function create()
    {
        $customers = User::query()->get();

        return view('admin.sales_management.susu.create', compact('customers'));
    }


    public function store(Request $request)
    {
        $data = $request->all();

        $validate = Validator::make($data, $this->validateFields());

        if ($validate->fails()){
            return $this->failResponse($validate->errors()->first());
        }


        foreach ($data['product_rows'] as $row){

            $name = (new InvoiceController())->getProductName($row['selected_product_id'])->name;

            $image = (new InvoiceController())->getProductName($row['selected_product_id'])->getSingleImage();

            Cart::add([
                'id' => $row['selected_product_id'],
                'name' => $name,
                'price' => $row['price'],
                'qty' => $row['quantity'] ?? 1,
                'options' => ['product_image' => $image, 'product_quantity' => $row['quantity']]
            ]);

        }

        $data['payment_status'] = 'Pending Payment';

        DB::beginTransaction();

        try{

            $invoice = Invoice::query()->create((new InvoiceController())->generateInvoice($data));

            $susu = Susu::query()->create($this->dumpSusuItems($data));

            $order = Order::query()->create((new InvoiceController())->generateOrder($data));

            $invoice->update(['order_id' => $order->id]);

            $order->update(['invoice_id' => $invoice->id]);

            foreach ($data['product_rows'] as $row){

                InvoiceItems::query()->create((new InvoiceController())->generateInvoiceItems($invoice->id, $row));

                SusuItem::query()->create($this->susuItems($susu->id, $row));

            }

            DB::commit();

            Cart::destroy();

            $this->fireSms($data);

            session()->flash('success', 'Susu entry created successfully');

            return $this->successResponse("Susu entry created successfully");


        }catch (\Exception $exception){
            DB::rollback();

            return $this->failResponse($exception->getMessage().' Line: '.$exception->getLine());

        }


    }


    public function fetchProducts()
    {
        return Product::query()->get();
    }

    public function edit(Susu $susu)
    {
        return $susu;
    }


    public function update(Request $request, Susu $susu)
    {
        return $request->all();
    }


    public function dumpSusuItems($data)
    {
        return [
            'user_id' => $data['customer'],
            'susu_number' => (new CheckoutController())->generateOrderCode('susu'),
            'shipping' => $data['shipping'],
            'discount_type' => $data['discount_type'],
            'discount_amount' => $data['discount_amount'],
            'discount_total' => $data['discount_total'],
            'sub_total' => $data['all_sub_total'],
            'net_total' => $data['all_net'],
            'remarks' => $data['remarks'],
            'amount_paid' => $data['initial_amount'],
            'payment_interval' => $data['payment_interval'],
            'expected_full_payment' => $this->getExpectedDate($data),
            'payment_status' => $data['payment_status']
        ];
    }


    public function susuItems($susu, $data)
    {
        return [
            'susu_id' => $susu,
            'product_id' => $data['selected_product_id'],
            'row_sub_total' => $data['row_sub_total'],
            'quantity' => $data['quantity'],
            'price' => $data['price'],
            'description' => $data['description'],
            'max_quantity' => $data['max_quantity'] ?? null
        ];
    }


    public function validateFields()
    {
        return [
            'customer' => 'required',
            'discount_amount' => 'required_if:discount_type,!=,null',
            'initial_amount' => 'required',
            'payment_interval' => 'required',
            'payment_status' => 'required'
        ];
    }


    public function getExpectedDate($data)
    {
        $interval = $data['payment_interval'];

        $net_total = $data['all_net'];

        $initial_payment = $data['initial_amount'];

        $date = Carbon::now();

        $estimated_payment = number_format($net_total / $initial_payment, 0);

        if ($interval === 'Daily'){
            $date = $date->addDays($estimated_payment);
        }

        if ($interval === 'Weekly'){
            $date = $date->addWeeks($estimated_payment);
        }

        if ($interval === 'Monthly'){
            $date = $date->addMonths($estimated_payment);
        }

        return $date;

    }


    public function fireSms($data)
    {

        $client = User::query()->where('id', $data['customer'])->first();

        if (!empty($client)){
            $sms_data = [
                'phone' => trim($client->phone, ' '),
                'msg' => "Hello $client->name, \r\n A new Susu Entry has been created for you. You are expected to pay GHC ".$data['all_net']." by ".date('l M d, Y', strtotime($this->getExpectedDate($data))).". For more details, kindly visit your portal at ".env('APP_URL')
            ];
            $this->sendSMS($sms_data);
        }
    }
}
