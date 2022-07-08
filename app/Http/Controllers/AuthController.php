<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Tymon\JWTAuth\Facades\JWTAuth;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        $validated = $request->validate([
            'nombre' => 'required',
            'password' => 'required'
        ]);
        $token = JWTAuth::attempt($validated);
        if (!$token) {
            return response([
                'message' => 'Credenciales incorrectas'
            ], 401);
        }
        return response([
            'token' => $token
        ], 200);
    }
}
