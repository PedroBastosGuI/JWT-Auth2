<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class AuthController extends Controller
{
    //

    public function __construct()
    {
        $this->middleware('auth:api', ['except' => ['login','register']]);
    }

    public function login(Request $request){
        $request->validate([
            'email' =>'required|string|email',
            'password' =>'required|string',
        ]);

        $credentials = $request->only('email', password);

        $token = Auth::attempt($credentials);

        if(!token){
            return response()->json([
                'status'=>'error',
                'message' => 'Unauthorized'
            ],401);
        }
    }


}
