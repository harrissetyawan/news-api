<?php

namespace App\Http\Controllers;

use Laravel\Passport\TokenRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class AuthController extends Controller
{
    // Login

    public function login(Request $request)
    {
        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials)) {
            $user = Auth::user();

            $tokenLabel = $user->admin ? "Admin Authenticated" : "User Authenticated";
            // $token = $user->createToken("User Login")->accessToken;
            $token = $user->createToken($tokenLabel)->accessToken;
            $isAdmin = $user->admin;

            return response()->json(['token' => $token, 'isAdmin' => $isAdmin], 200);
        }

        return response()->json(['error' => 'Unauthorized'], 401);
    }

    public function logout(Request $request)
    {
        $request->user()->token()->revoke();
        return response()->json(['message' => 'Successfully logged out'], 200);
    }
}
