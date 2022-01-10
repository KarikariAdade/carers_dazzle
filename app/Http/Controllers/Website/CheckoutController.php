<?php

namespace App\Http\Controllers\Website;

use App\Http\Controllers\Controller;
use App\Models\Invoice;
use App\Models\Order;
use App\Models\Regions;
use App\Models\Towns;
use App\Models\User;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use Barryvdh\DomPDF\Facade as PDF;

class CheckoutController extends Controller
{
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

        $region = Regions::query()->where('id', $shipping_data['shipping']['region'])->first();

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

        $data['meta'] = Cart::content();

        $order = Order::query()->create( $this->createOrder($data));

        $invoice = Invoice::query()->create($this->createInvoice($data, $order->id));

        $data['msg'] = 'Dear '.$data['name'].', your order('.$order->order_id.') has been placed. Please visit your portal or your email to download your invoice.';

        $this->sendSMS($data);

        if ($data['payment_method'] === 'momo'){

            $total = session()->get('checkout_data') ? 'GHS '.number_format(session()->get('checkout_data.total'), 2) : number_format(Cart::subtotal(0,'', ''));

            $data['msg'] = 'Dear '.$data['name'].', kindly pay an amount of '.$total.' to 0548876922 via momo to complete your order. Account name is Karikari Adade. Kindly use '.$order->trans_code.' as reference ID';

            $this->sendSMS($data);
        }

        $data['order_id'] = $order->order_id;

        $pdf = PDF::loadView('emails.invoice_attach')->setPaper('A4');

        $data['msg'] = 'Dear '.$data['name'].', your order('.$data['order_id'].') has been placed. Please visit your portal or your email to download your invoice.';

        Mail::send('emails.orders', ['data'=>$data], function($message)use($data, $pdf, $invoice) {
            $message->to($data["email"], $data["name"])
                ->subject('Order ('.$data['order_id'].') made successfully')
                ->attachData($pdf->output(), $invoice->invoice_number.'.pdf', [
                    'mime' => 'application/pdf',
                ]);
        });

        session()->remove('checkout_data');

        session()->remove('delivery_bill');

        Cart::destroy();

        Session::flash('success', 'You have successfully placed your order. ');

        return $this->successResponse("Order made successfully");
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

        $data['message'] = $msg;

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
            'trans_code' => Str::random(5),
        ];
    }


    public function computeTownAndRegion($data, $type)
    {
        if ($type === 'town'){
            return Towns::query()->where('name', 'LIKE', $data)->first()->id;

        }

        return Regions::query()->where('name', 'LIKE', $data)->first()->id;
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

        }else{
            $batch = "ODR" . sprintf('%06d', Order::query()->count() + $int);

            $exist = Order::query()->where('order_id',$batch)->first();
        }

        return empty($exist) ? $batch : $this->generateOrderCode(++$int);
    }
}
