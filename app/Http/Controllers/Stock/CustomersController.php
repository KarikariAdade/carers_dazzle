<?php

namespace App\Http\Controllers\Stock;

use App\DataTables\ClientInvoiceDatatable;
use App\DataTables\CustomersDatatable;
use App\Http\Controllers\Controller;
use App\Models\Customer;
use App\Models\User;
use Cassandra\Custom;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;

class CustomersController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    public function index(CustomersDatatable $datatable)
    {
        return $datatable->render('admin.sales_management.customers.index');
    }


    public function store(Request $request)
    {
        $data = $request->all();

        $validate = Validator::make($data, $this->validateFields());

        if ($validate->fails()){
            return $this->failResponse($validate->errors()->first());
        }

        $data['password'] = random_int(11111, 99999);
        $data['type'] = 'Customer Account Creation';


        DB::beginTransaction();

        try {

            $user = User::query()->create($this->dumpData($data));

            $this->sendSMS($data);

            DB::commit();

            if ($request->get('source') === 'susu'){
                return response()->json(['code' => 200, 'user' => $user,  'msg' => 'User created successfully']);
            }

            return $this->successResponse('Customer created successfully');

        }catch (\Exception $e){
            DB::rollback();

            Log::error($e->getMessage());
        }

        return $this->failResponse("Customer could not be created");


    }

    public function details(ClientInvoiceDatatable $datatable, User $customer)
    {
        return $datatable->with('id', $customer->id)->render('admin.sales_management.customers.details', compact('customer'));
    }



    public function validateFields($user = null)
    {
        return [
            'full_name' => 'required|min:3',
            'phone' => 'required|regex:/^([0-9\s\-\+\(\)]*)$/|min:10|max:18',
            'email' => 'required|email|unique:users,email'.$user,
        ];
    }

    public function dumpData($data)
    {
        return [
            'name' => $data['full_name'],
            'email' => $data['email'],
            'phone' => $data['phone'],
            'password' => bcrypt($data['password']),
        ];
    }


    public function sendSMS($data)
    {
        $msg = 'Dear '.$data['full_name'].', your account on E-SQUARE ELECTRONICS has been processed successfully. Kindly access your account via '.route('website.index').'. Password: '.$data["password"].', Thank You';
        $fields = [
            'sender' => 'LBH',
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

        $this->logSMSData($data,$result);

        return $result;
    }


}
