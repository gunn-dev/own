<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Laravel\Passport\TokenRepository;

class AuthController extends Controller
{
    public function register(Request $request) {
        $validated = $request->validate([
           'name' => 'required|max:55',
           'email' => 'email|required|unique:users',
           'password' => 'required' 
        ]);
        $validated['password'] = bcrypt($request->password);
        $user = User::create($validated);
        $accessToken = $user->createToken('authToken')->accessToken;

        return response(['user' => $user, 'access_token' => $accessToken]);
    }

    public function login(Request $request) {
        $loginData = $request->validate([
            'email' => 'email|required',
            'password' => 'required'
        ]);

        if ( !Auth::attempt($loginData) ) {
            return response(['message' => 'Invalid Credentials']);
        }
        $accessToken = Auth::user()->createToken('authToken')->accessToken;
        return response(['user' => auth()->user(), 'access_token' => $accessToken]);
    }

    public function logout(Request $request) {
        $loginData = $request->validate([
            'email' => 'email|required',
            'password' => 'required'
        ]);

        if ( !Auth::attempt($loginData) ) {
            return response(['message' => 'Invalid Credentials']);
        }
        $tokenId = Auth::user()->tokens;
        // dd($tokenId);
        $tokenRepository = app(TokenRepository::class);
        $tokenRepository->revokeAccessToken($tokenId);
        return response()->json([
            'message' => 'Successfully logged out'
        ]);
    }
}
