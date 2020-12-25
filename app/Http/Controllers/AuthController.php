<?php

namespace App\Http\Controllers;
// call Illuminate
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\User;


class AuthController extends Controller
{
    // register method
    public function register(Request $request)
    {
        $username = $request->input('username');
        $email = $request->input('email');
        $password = Hash::make($request->input('password'));
        
        $register = User::create([
            'username' => $username,
            'email' => $email,
            'password' => $password
        ]);

        if($register){
            return response()->json([
                'success' => true,
                'message' => 'User Registered',
                'data' => $register
            ], 201);
        } else {
            return response()->json([
                'success' => false,
                'message' => 'User Not Registered',
                'data' => ''
            ], 400);
        }

    }

    // login method
    public function login(Request $request)
    {

    }
}
