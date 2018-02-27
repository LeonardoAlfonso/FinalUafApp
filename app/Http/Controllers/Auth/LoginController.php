<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class LoginController extends Controller
{

    use AuthenticatesUsers;

    public function __construct()
    {
        // $this->middleware('guest')->except('logout');
    }

    protected function redirectTo()
    {
        if( Auth::user()->role === 'admin' ){
            return route('admin');
        }
        elseif ( Auth::user()->role === 'expert' ) {
            return route('expertView');
        }
        elseif ( Auth::user()->role === 'cartographer' ) {
            return route('cartographer');
        }
    }

    public function logout(Request $request)
    {
        $this->guard()->logout();
        $request->session()->invalidate();
        return redirect()->route('home');
    }

}
