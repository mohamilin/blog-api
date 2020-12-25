<?php

namespace App\Http\Controllers;
use App\Models\User;

class UserController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function showUser($id)
    {
        $user = User::find($id);
        if($user){
            return response()->json([
                'status' => true,
                'message' => 'Success show user',
                'data' => $user
            ], 200);
        } else {
            return response()->json([
                'status' => false,
                'message' => 'Success not show user',
                'data' => ''
            ], 400);
        }   
    }
}
