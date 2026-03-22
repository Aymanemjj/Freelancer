<?php

namespace App\Services;

use App\Http\Requests\RegisterRequest;
use App\Http\Resources\AuthResource;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthService
{
    /**
     * Create a new class instance.
     */
    public function __construct()
    {
        //
    }

    public function register(RegisterRequest $request)
    {
        $credentials = $request->validated();
        $credentials['rating'] = 0;
        $credentials['password'] = bcrypt($credentials['password']);

        $user = User::create($credentials);
        $token = $user->createToken('freelancers')->plainTextToken;

        return response()->json([
            'success' => true,
            'message' => 'Registerd user',
            'data' => ['user' => AuthResource::make($user), 'token' => $token]
        ]);
    }

    public function login($request)
    {
        $credentials = $request->validated();

        if (!Auth::attempt($credentials)) {
            return response()->json([
                'success' => false,
                'message' => 'Wrong credentials'
            ], 401);
        }

        $user = Auth::user();
        /* check later */
        $token = $user->createToken('freelancers')->plainTextToken;

        return ["token" => $token, 'user' => AuthResource::make($user),];
    }



    public function logout(Request $request)
    {
        Auth::user()->currentAccessToken()->delete();
    }
}
