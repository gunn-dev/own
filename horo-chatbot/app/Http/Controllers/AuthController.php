<?php

namespace App\Http\Controllers;

use Illuminate\Auth\Authenticatable;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;

class AuthController extends Controller
{
    use Authenticatable;

    protected $redirectTo = '/admin/home';

    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }
    public function index()
    {
        if (Auth::check()) {
           if(Auth::user()->id == 1){
               return redirect('admin/dashboard');
           }else{
               return redirect()->route('starphone.payment');
           }
        }
        return view('admin.auth.login');
    }

    public function postLogin(Request $request)
    {

        request()->validate([
            'email' => 'required',
            'password' => 'required',
        ]);

        $credentials = $request->only('email', 'password');
        if (Auth::attempt($credentials)) {
            if(Auth::user()->id == 1){
                return redirect()->intended('admin/home');
            }else{
                return redirect()->route('starphone.payment');
            }

        }
        return Redirect::to("admin/login")->with('error','Oppes! You have entered invalid credentials');

    }

    public function logout()
    {
        Session::flush();
        Auth::logout();
        return Redirect('admin/login');
    }
}
