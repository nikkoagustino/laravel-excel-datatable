<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Session;

class AuthController extends Controller
{
    public function formLogin() {
        return view('auth.login');
    }

    public function submitLogin(Request $request) {
        if ($request->access_key === config('osten.ACCESS_KEY')) {
            Session::put('authenticated', true);
            return redirect('/');
        } else {
            return back();
        }
    }

    public function logout() {
        Session::flush();
        return redirect('/');
    }
}
