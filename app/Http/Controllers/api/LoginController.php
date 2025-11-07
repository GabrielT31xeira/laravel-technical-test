<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Http\Requests\LoginRequest;
use App\Http\Requests\LogoutRequest;
use App\Http\Requests\RegisterRequest;
use App\Http\Services\api\AuthServices;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    protected AuthServices $authServices;

    public function __construct(AuthServices $authServices)
    {
        $this->authServices = $authServices;
    }
    public function login(LoginRequest $request)
    {
        $response = $this->authServices->login($request->validated());
        return response()->json($response);
    }

    public function register(RegisterRequest $request)
    {
        $response = $this->authServices->register($request->validated());
        return response()->json($response, 201);
    }

    public function profile()
    {
        $response = $this->authServices->profile(Auth::user()->getAuthIdentifier());
        return response()->json($response);
    }

    public function logout(LogoutRequest $request)
    {
        $response = $this->authServices->logout($request->validated());
        return response()->json($response);
    }
}
