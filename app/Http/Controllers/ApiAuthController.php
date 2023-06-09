<?php

namespace App\Http\Controllers;

use App\Http\Requests\Auth\LoginRequest;
use Tymon\JWTAuth\Facades\JWTAuth;

class ApiAuthController extends Controller
{
    public function authenticate(LoginRequest $request)
    {
        $credentials = $request->only('email', 'password');

        if (! $token = JWTAuth::attempt($credentials)) {
            return response(json_encode(['Error' => 'Invalid credentials']), 401)
                ->header('Content-Type', 'application/json');
        }

        return response(json_encode(['token' => $token]), 200)
            ->header('Content-Type', 'application/json');
    }
}
