<?php

namespace App\Services;

use App\Http\Requests\RegisterRequest;
use App\Models\User;

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
        $token = $user->createToken('wallet_api')->plainTextToken;

        return response()->json([
            'success'=> true,
            'message'=> 'Registerd user',
            'data'=>['user'=> AuthService::make($user), 'token'=> $token]
        ]);
    }
}
