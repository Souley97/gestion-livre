<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{



    public function login(Request $request)
    {
        $validator = validator($request->all(), [
            'email' => ['required', 'email', 'string'],
            'password' => ['required', 'string'],
        ]);

        if ($validator->fails()) {
            return response()->json([
                'errors' => $validator->errors(),
            ], 422);
        }

        $credentials = $request->only(['email', 'password']);

        if (!$token = auth()->guard('api')->attempt($credentials)) {
            return response()->json([
                'message' => 'Invalid lin credentials',
            ], 401);
        }

        return response()->json([
            'access_token' => $token,
            'token_type' => 'bearer',
            'user' => auth()->guard('api')->user(),
            'expires_in' => auth()->guard('api')->factory()->getTTL() * 60,
        ]);
    }
    // logout
    public function logout(Request $request)
    {
        auth()->user()->tokens()->delete();

        return response()->json([
           'message' => 'Logout successful',
        ], 200);
    }


    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nom' =>'required|string|max:255',
            'prenom' =>'required|string|max:255',
            'email' =>'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
        ]);

        if ($validator->fails()) {
            return response()->json(['error'=>$validator->errors()], 422);
        }

        $user = User::create([
            'nom' => $request->nom,
            'prenom' => $request->prenom,
            'email' => $request->email,
            'password' =>  bcrypt($request->password),
        ]);

        $token = $user->createToken('authToken')->plainTextToken;

        return response()->json([
            'user' => $user,
            'access_token' => $token
        ]);
    }


}
