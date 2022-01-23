<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AdminDashboardController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    public function index()
    {
        return view('admin.dashboard');
    }

    public function updatePhone(Request $request)
    {
        $phone = $request->get('phone');

        if (empty($phone)){
            return $this->failResponse("Phone Number field should not be empty");
        }

        if (auth()->guard('admin')->user()->updatePhone($phone)){
            return $this->successResponse("Phone Number updated successfully");
        }

        return $this->failResponse("Phone Number could not be updated");
    }
}
