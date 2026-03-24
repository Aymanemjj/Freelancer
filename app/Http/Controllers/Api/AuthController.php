<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\LoginRequest;
use App\Http\Requests\RegisterClientRequest;
use App\Http\Requests\RegisterRequest;
use App\Services\AuthService;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    protected AuthService $AuthService;

    public function __construct()
    {
        $this->AuthService = new AuthService;
    }

    public function register(RegisterRequest $request){
        $this->AuthService->register($request);
    }

    public function login(LoginRequest $request){
        $this->AuthService->login($request);
    }

        public function logOut(Request $request)
    {
        try {
            $this->AuthService->logOut($request);
            return response()->json([
                'success' => true,
                'message' => 'Déconnexion réussie.',
            ], 200);
        } catch (AuthorizationException $e) {
            return response()->json([
                'success' => false,
                'message' => $e->getMessage(),
            ], 500);
        }
    }

}
