<?php

namespace App\Http\Controllers\Website;

use App\Helpers\ShopHelper;
use App\Http\Controllers\Controller;
use App\Models\Invoice;
use App\Models\InvoiceItems;
use App\Models\Order;
use App\Models\Payment;
use App\Models\Regions;
use App\Models\Countries;

use App\Models\Susu;
use App\Models\Towns;
use App\Models\User;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use Barryvdh\DomPDF\Facade as PDF;
use Unicodeveloper\Paystack\Facades\Paystack;

class CheckoutController extends Controller
{

    private $shop_helper;

    public function __construct()
    {
        $this->shop_helper = new ShopHelper();
    }

    public function index()
    {
        $checkout_data = session()->get('checkout_data');

        $shipping_data = session()->get('delivery_bill');

        $user = auth()->guard('web')->user();

        if (empty($checkout_data)) {
            return redirect()->route('website.cart.index')->withErrors('Add items to cart before checking out');
        }

        if (empty($shipping_data)) {
            return redirect()->route('website.cart.index')->withErrors('Add shipping data before you checkout');
        }

        $region = Countries::query()->where('id', $shipping_data['shipping']['region'])->first();

        $town = Towns::query()->where('id', $shipping_data['shipping']['town'])->first();

        return view('website.checkout.index', ['pageItems' => $this->pageDependencies(), 'region' => $region, 'town' => $town, 'user' => $user]);
    }


    public function customerLogin(Request $request)
    {
        $data = $request->only(['email', 'password']);

        $validate = Validator::make($data, [
            'email' => 'required|email',
            'password' => 'required'
        ]);

        if ($validate->fails())
            return $this->failResponse($validate->errors()->first());

        if (Auth::guard('web')->attempt($data)){

            Session::flash('success', 'Welcome back, '.auth()->guard('web')->user()->name);

            return $this->successResponse('User logged in');
        }

        return $this->failResponse('Incorrect email address or password');
    }


    public function order(Request $request)
    {
        $data = $request->all();

        $validate = Validator::make($data, $this->validateOrderFields(), ['account_password.required_with' => 'Account Password is required when Create an Account is checked']);

        if ($validate->fails()){
            return $this->failResponse($validate->errors()->first());
        }

        if(isset($data['create_pwd'])){
            $check_user = User::query()->where('email', $data['email'])->first();

            if (empty($check_user)){

                $user = User::query()->create($this->createUserAccount($data));

                Auth::guard('web')->attempt(['email' => $user->email, 'password' => $user->password]);

            }

        }


        if (isset($data['checkout_diff_address'])){

            if (empty($data['diff_street_address']) || empty($data['diff_town']) || empty($data['diff_city']) || empty($data['diff_post_code'])){

                return $this->failResponse('Kindly fill all fields under new shipping address');

            }

            $this->runCheckoutForDiffAddress($data);

        }

        $data['meta'] = Cart::content();

        $payable_amount = session()->get('checkout_data') ? session()->get('checkout_data.total') : Cart::subtotal(0,'', '');

        $payable_amount = explode(' ', $this->shop_helper->calculateExchangeRate($payable_amount));

        $data['net_total'] = session()->get('checkout_data') ? session()->get('checkout_data.total') : Cart::subtotal(0,'', '');

        $order = Order::query()->create( $this->createOrder($data));

        $invoice = Invoice::query()->create($this->createInvoice($data, $order->id));

        $order->update(['invoice_id' => $invoice->id]);

        $data['order_id'] = $order->order_id;

        $invoice_items = json_decode($invoice->meta, true);

        $pdf = PDF::loadView('emails.invoice_attach', ['invoice' => $invoice, 'invoice_items' => $invoice_items])->setOptions(['defaultFont' => 'sans-serif'])->setPaper('A4');

        $data['msg'] = 'Dear '.$data['name'].', your order('.$data['order_id'].') has been placed. Please visit your portal or your email to download your invoice.';

        Mail::send('emails.orders', ['data'=>$data], function ($message) use ($data, $pdf, $invoice) {
            $message->to($data["email"], $data["name"])
                ->subject('Order ('.$data['order_id'].') made successfully')
                ->attachData($pdf->output(), $invoice->invoice_number.'.pdf', [
                    'mime' => 'application/pdf',
                ]);
        });

        if ($data['payment_method'] === 'payment_on_delivery'){

            session()->remove('checkout_data');

            session()->remove('delivery_bill');

            Cart::destroy();

            return response()->json([
                'code' => 200,
                'msg' => $data['msg'],
                'url' => route('website.checkout.payment.delivery', ['order' => $order]),
            ]);
        }


        $payment_data = [
            'email' => "iamkarikari98@email.com",
            'amount' => (int) $payable_amount[1] * 100, #TODO check if client can enable USD in portal, else change to cedis
            'currency' => $payable_amount[0] === '$' ? 'GHS' : $payable_amount[0]
        ];

        $result = $this->initiatePaymentProcess($payment_data);


        if ($result['status'] === true){
            Payment::query()->create([
                'invoice_id' => $invoice->id,
                'order_id' => $order->id,
                'reference_id' => $result['data']['reference'],
                'amount' => $data['net_total'],
                'status' => 'processing'
            ]);
            return response()->json([
                'code' => 200,
                'msg' => "Order made successfully. Thanks for doing business with Carers Dazzle",
                'url' => $result['data']['authorization_url'],
            ]);
        }

        return $this->failResponse('Payment could not be initiated. Kindly try again or contact support');

    }


    public function initiatePaymentProcess($fields)
    {
        $url = env('PAYSTACK_PAYMENT_URL');

        $fields_string = http_build_query($fields);

        $ch = curl_init();

        curl_setopt($ch,CURLOPT_URL, $url);

        curl_setopt($ch,CURLOPT_POST, true);

        curl_setopt($ch,CURLOPT_POSTFIELDS, $fields_string);

        curl_setopt($ch, CURLOPT_HTTPHEADER, array(
            "Authorization: Bearer ".env('PAYSTACK_SECRET_KEY'),
            "Cache-Control: no-cache",
        ));

        curl_setopt($ch,CURLOPT_RETURNTRANSFER, true);

        $result = curl_exec($ch);

        return json_decode($result, true, 512, JSON_THROW_ON_ERROR);
    }


    public function sendSMS($data)
    {
        $msg = $data['msg'];
        $fields = [
            'sender' => 'E-SQUAREGH',
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


    public function runCheckoutForDiffAddress(&$data)
    {
        $data['street_address'] = $data['diff_street_address'];

        $data['town'] = $data['diff_town'];

        $data['region'] = $data['diff_city'];

        $data['post_code'] = $data['diff_post_code'];

        return $data;
    }


    public function validateOrderFields()
    {
        return [
            'name' => 'required',
            'email' => 'required|email',
            'order_note' => 'nullable',
            'payment_method' => 'required',
            'phone' => 'regex:/^([0-9\s\-\+\(\)]*)$/|min:10|max:18|required',
            'postcode' => 'required',
            'region' => 'required',
            'street_address' => 'required',
            'town' => 'required',
            'account_password' => 'nullable|required_with:create_pwd,on|min:8',
        ];
    }

    public function createUserAccount($data)
    {
        return [
            'name' => $data['name'],
            'email' => $data['email'],
            'phone' => $data['phone'],
            'region' => $this->computeTownAndRegion($data['region'], 'region'),
            'town' => $this->computeTownAndRegion($data['town'], 'town'),
            'street_address_1' => $data['street_address'],
            'street_address_2' => $data['street_address_secondary'],
            'password' => bcrypt($data['account_password']),
        ];
    }


    public function createOrder($data)
    {
        return [
            'user_id' => auth()->guard('web')->user()->id ?? null,
            'meta' => $data['meta'],
            'street_address_1' => $data['street_address'],
            'street_address_2' => $data['street_address_secondary'],
            'town_id' => $this->computeTownAndRegion($data['town'], 'town'),
            'region_id' => $this->computeTownAndRegion($data['region'], 'region'),
            'zip_code' => $data['postcode'],
            'name' => $data['name'],
            'email' => $data['email'],
            'sub_total' => Cart::subtotal(0,'', ''),
            'discount' => session()->get('checkout_data.sub_total') ?? 0,
            'shipping' => session()->get('checkout_data.delivery') ?? 0,
            'net_total' => session()->get('checkout_data') ? session()->get('checkout_data.total') : Cart::subtotal(0,'', ''),
            'payment_type' => $data['payment_method'],
            'order_id' => $this->generateOrderCode('order'),
            'order_status' => 'Pending Payment',
            'order_note' => $data['order_note'],
            'trans_code' => random_int(111111, 999999),
        ];
    }


    public function computeTownAndRegion($data, $type)
    {
        if ($type === 'town'){
            return Regions::query()->where('name', 'LIKE', '%'.$data.'%')->first()->id ?? null;

        }

        return Countries::query()->where('name', 'LIKE', $data)->first()->id ?? null;
    }


    public function createInvoice($data, $order)
    {
        return [
            'user_id' => auth()->guard('web')->user()->id ?? null,
            'order_id' => $order,
            'invoice_number' => $this->generateOrderCode('invoice'),
            'meta' => $data['meta'],
            'payment_type' => $data['payment_method'],
            'payment_status' => "Pending Payment",
        ];
    }




    public function generateOrderCode($type, $int = 1)
    {
        if ($type === 'invoice'){

            $batch = 'INV'.sprintf('%06d', Invoice::query()->count() + $int);

            $exist = Invoice::query()->where('invoice_number', $batch)->first();

        }elseif($type === 'susu'){

            $batch = 'SU'.sprintf('%06d', Susu::query()->count() + $int);

            $exist = Susu::query()->where('susu_number', $batch)->first();

        }else{

            $batch = "ODR" . sprintf('%06d', Order::query()->count() + $int);

            $exist = Order::query()->where('order_id',$batch)->first();
        }


        return empty($exist) ? $batch : $this->generateOrderCode(++$int);
    }


    public function callback(Request $request)
    {

        $validator = $this->validatePayment($request);

        if (!empty($validator['error'])) {
            return "cURL Error #:" . $validator['error'];
        }

        $response = json_decode($validator['response'],true);


        $status = $response['data']['status'];

        $payment = Payment::query()->where('reference_id', $request->get('reference'))->first();

        if ($status === 'success'){

            session()->remove('checkout_data');

            session()->remove('delivery_bill');

            Cart::destroy();

            if (!empty($payment)){

                $payment->update(['status' => 'success']);

                $payment->getOrder->update(['order_status' => 'Paid']);

                foreach (json_decode($payment->getOrder->meta, false, 512, JSON_THROW_ON_ERROR) as $item) {
                    $this->shop_helper->runOrderProcesses($item);
                }

                $payment->getInvoice->update(['payment_status' => 'Paid']);

            }

        }else if (!empty($payment)){

            $payment->update(['status' => 'fail']);

        }

        return view('website.checkout.status', compact('status', 'payment'));
    }


    public function validatePayment(Request $request)
    {
        $curl = curl_init();


        curl_setopt_array($curl, array(
            CURLOPT_URL => "https://api.paystack.co/transaction/verify/".$request->get('reference'),
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "GET",
            CURLOPT_HTTPHEADER => array(
                "Authorization: Bearer ".env('PAYSTACK_SECRET_KEY'),
                "Cache-Control: no-cache",
            ),
        ));

        $response = curl_exec($curl);
        $err = curl_error($curl);
        curl_close($curl);

        return [
            'error' => $err,
            'response' => $response
        ];
    }


    public function status()
    {
        return view('website.checkout.status');
    }


    public function payOnDelivery(Order $order)
    {
        return view('website.checkout.payment_on_delivery', compact('order'));
    }
}
