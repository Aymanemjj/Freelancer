<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\RegisterClientRequest;
use App\Http\Requests\RegisterRequest;
use App\Services\AuthService;
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
}
