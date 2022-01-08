<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class AuthController extends Controller
{
   public function register(Request $request) {
       $validated = $request->validate([
           'name' => 'required',
           'email' => 'email|required',
           'password' => 'required'
       ]);

       $user  = User::create([
           'name' => $request->name,
           'email' => $request->email,
           'password' => bcrypt($request->password)
       ]);
       $token = Auth::login($user);
       return $this->respondWithToken($token);
   }

   public function login(Request $request) {
       $credentials = $request->only(['email', 'password']);

       if (!$token = Auth::attempt($credentials)) {
           return response()->json([
               'error' => 'Unauthorized'
           ], 401);
       }
       return $this->respondWithToken($token);
   }

   public function me() {
       return response()->json(Auth::user());
   }

   public function logout() {
       Auth::logout();
       return response()->json(['message' => 'Successsfully Logout']);
   }

   public function refresh() {
       return $this->respondWithToken(Auth::refresh());
   }

   protected function respondWithToken($token) {
       return response()->json([
           'access_token' => $token,
           'token_type' => 'bearer',
        //    'expires_id' => Auth::factory()->getTTL()*60
       ]);
   }
}
