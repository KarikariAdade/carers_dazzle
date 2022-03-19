<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminAuthController extends Controller
{

    use AuthenticatesUsers;

    public function __construct()
    {
        $this->middleware('guest')->except('logout');
        $this->middleware('guest:admin')->except('logout');
    }

    public function index()
    {
        return view('admin.auth.login');
    }


    public function login(Request $request)
    {
        $data = $request->only('email', 'password');

        if (Auth::guard('admin')->attempt(['email' => $data['email'], 'password' => $data['password']])){

            return redirect()->intended(route('admin.dashboard'));
        }

        return back()->with('error', 'Invalid Email Address or Password');
    }


    public function logout()
    {
        auth()->guard('admin')->logout();

        return redirect()->route('admin.auth.login.index');
    }
}
