<?php

namespace App\Http\Controllers;
// call Illuminate
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use App\Models\User;


class AuthController extends Controller
{
    // register method
    public function signup(Request $request)
    {
        $username = $request->input('username');
        $email = $request->input('email');
        $password = Hash::make($request->input('password'));

        $register = User::create([
            'username' => $username,
            'email' => $email,
            'password' => $password
        ]);

        if ($register) {
            return response()->json([
                'status' => true,
                'message' => 'User Registered',
                'data' => $register
            ], 201);
        } else {
            return response()->json([
                'status' => false,
                'message' => 'User Not Registered',
                'data' => ''
            ], 400);
        }
    }

    // login method
    public function signin(Request $request)
    {
        $email = $request->input('email');
        $password = $request->input('password');

        // find data in database
        $user = User::where('email', $email)->first();
        if (Hash::check($password, $user->password)) {
            $apitoken = base64_encode(Str::random(40));
            $user->update([
                'api_token' => $apitoken
            ]);
            return response()->json([
                'status' => true,
                'message' => 'Login Success',
                'data' => [
                    'user' => $user,
                    'api_token' => $apitoken
                ]
            ], 201);
        } else {
            return response()->json([
                'status' => false,
                'message' => 'Login Failed',
                'data' => ''
            ], 400);
        }
    }
}
