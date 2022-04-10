<?php

namespace App\Http\Controllers\Customers;

use App\DataTables\Customer\InvoiceDatatable;
use App\DataTables\Customer\OrdersDatatable;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Website\HomepageController;
use App\Models\Invoice;
use App\Models\Order;
use App\Models\Regions;
use Barryvdh\DomPDF\Facade as PDF;
use http\Client\Curl\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;

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
        return view('customers.dashboard');
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

        $regions = Regions::query()->get();

        $name = explode(' ',auth()->user()->name);

        $firstname = array_shift($name);
        $lastname  = implode(" ", $name);

        return view('customers.account.index', compact('pageItems', 'regions', 'firstname', 'lastname'));
    }


    public function updateAccountDetails(Request $request)
    {
        $user = \App\Models\User::query()->where('id', auth()->user()->id)->first();
        $data = $request->all();

        $validator = Validator::make($data, [
            'first_name' => 'required',
            'last_name' => 'required',
            'email' => 'required|email',
            'region' => 'required',
            'street_address_1' => 'required',
            'street_address_2' => 'nullable',
            'town' => 'required',
            'zip_code' => 'nullable',
            'new_password' => 'required_with:current_password',
            'confirm_password' => 'required_with:new_password',
        ]);

        if ($validator->fails()){
            return $this->failResponse($validator->errors()->first());
        }

        DB::beginTransaction();

        try{
            if (!empty($data['current_password'])){
                if (!empty($data['new_password']) && !empty($data['confirm_password'])){
                    if ($data['new_password'] !== $data['confirm_password']){
                        return $this->failResponse("Confirmed Password is not equal to New Password");
                    }

                    $user->update([
                        'password' => bcrypt($data['new_password'])
                    ]);


                }else{
                    return $this->failResponse("New Password and Confirm Password fields are required if Current Password is not empty");
                }
            }

            $user->update([
                'name' => $data['first_name'].' '.$data['last_name'],
                'email' => $data['email'],
                'region_id' => $data['region'],
                'street_address_1' => 'required',
                'street_address_2' => 'nullable',
                'town_id' => $data['town'],
                'zip_code' => $data['zip_code'],
            ]);

            session()->flash('success', 'Profile successfully updated');

            DB::commit();

            return $this->successResponse("Profile successfully updated");


        } catch (\Exception $exception){
            DB::rollBack();
            Log::info($exception->getMessage());

            return $this->failResponse("Failed to update. Try again later");
        }


    }
}
