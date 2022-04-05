<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    public function register(Request $request)
    {
        $data = $request->only(['name', 'email', 'password', 'password_confirmation']);

        $validate = Validator::make($data, [
            'name' => 'required',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:8|confirmed'
        ]);

        if ($validate->fails()){
            return $this->failResponse($validate->errors()->first());
        }

        $user = User::query()->create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => bcrypt($data['password'])
        ]);

        return $this->successResponse("$user->name, your account has been created. Kindly login to access your dashboard");
    }


    public function loginUser(Request $request)
    {
        $data = $request->only(['email', 'password']);

        $validate = Validator::make($data, [
            'email' => 'required|email',
            'password' => 'required'
        ]);

        if ($validate->fails()){
            return $this->failResponse($validate->errors()->first());
        }


        if (Auth::guard('web')->attempt(['email' => $data['email'], 'password' => $data['password']])){

            return $this->successResponse(route('customer.dashboard'));
        }

        return $this->failResponse('Invalid Email or Password');
    }
}
