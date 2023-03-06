<?php

namespace App\Http\Controllers\Api;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Requests\LoginRequest;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Http\Resources\LoginResource;

class AuthController extends Controller
{
    public function login(LoginRequest $request)
    {
        $credentials = $request->only('email', 'password');
        if (Auth::attempt($credentials)) {
            $user = User::where('email', $request->email)->first();
            $user->tokens()->delete();
            $token = $user->createToken('token')->plainTextToken;
            return new LoginResource([
                'token' => $token,
                'user' => $user
            ]);
        } else {
            return response()->json([
                'message' => 'Invalid Credentials'
            ], 401);
        }

    }

    public function logout(Request $request)
    {
        $request->user()->tokens()->delete();
        return response()->noContent();
    }
}
