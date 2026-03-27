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
        $abilities = null;
        if($user['role'] == 'client'){
            $abilities = ['mission:create', 'mission:edit', 'mission:delete', 'candidate:accept', 'candidate:refuse'];
        }else if($user['role'] == 'freelancer'){
            $abilities = ['candidate:create', 'candidate:edit', 'candidate:delete'];
        }
        $token = $user->createToken('freelancers', $abilities)->plainTextToken;

        return response()->json([
            'success' => true,
            'message' => 'Registerd user',
            'data' => ['user' => AuthResource::make($user), 'token' => $token]
        ],200);
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
