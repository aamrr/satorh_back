<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Illuminate\Support\Facades\Hash;


class AuthController extends Controller
{

    /**
     * @OA\Post(
     * path="/login",
     * summary="Sign in",
     * description="Login by email/login , password",
     * operationId="authLogin",
     * tags={"auth"},
     * @OA\RequestBody(
     *    required=true,
     *    description="Pass user credentials",
     *    @OA\JsonContent(
     *       required={"email","password"},
     *       @OA\Property(property="email", type="string"),
     *       @OA\Property(property="password", type="string", format="password"),
     *       @OA\Property(property="persistent", type="boolean"),
     *    ),
     * ),
     * @OA\Response(
     *    response=422,
     *    description="Wrong credentials response",
     *    @OA\JsonContent(
     *       @OA\Property(property="message", type="string", example="Sorry, wrong email address or password. Please try again")
     *        )
     *     ),
     * @OA\Response(
     *     response=200,
     *     description="Success",
     *     @OA\JsonContent(
     *        @OA\Property(property="user", type="object"), ref="#/components/schemas/User")
     *     )
     *  ),
     * ),
     */

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
            ], 422);
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
