<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Illuminate\Support\Facades\Hash;


class AuthController extends Controller
{
    public function login(Request $request){

        $data = $request->validate([
            'email' => 'required',
            'password' => 'required'
        ]);
        
        // an email can be an email or the LOGIN string

        if (strpos($request->email, '@')){
            $user = User::where('email', $request->email)->first();
        }else{
            $user = User::where('login', $request->email)->first();
        }
        if (!$user || !Hash::check($request->password, $user->password)) {
            return response([
                'message' => ['wrong credentials!']
            ], 401);
        }

        $token = $user->createToken('satori-token')->plainTextToken;

        $role = $user->getRoleNames()->first();
        $response = [
            'user' => $user,
            'token' => $token,
        ];

        return response($response, 201);
    }

    public function logout(Request $request)
	{
		$request->user()->tokens()->delete();
		return response()->json([
			'message' => 'Successfully logged out'
		]);
	}
}
