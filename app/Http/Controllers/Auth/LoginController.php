<?php

namespace App\Http\Controllers\Auth;

use Auth;
use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;

class LoginController extends Controller
{
    public function __construct(){
        $this->middleware('guest', ['only' => 'showLoginForm']);
    }

    public function showLoginForm(){
        return view('auth.login');
    }

    public function login(){
        $credentials = $this->validate(request(), [
            'email' => 'email|required|string',
            'password' => 'required|string'
        ]);

        if (Auth::attempt($credentials)){
            return redirect()->route('dashboard');
        }

        return back()
            ->withErrors(['email' => 'Estas credenciales no coinciden con nuestros registros'])
            ->withInput(request(['email']));
    }

    public function logout(){
        Auth::logout();
        return redirect('/');
    }
}
