<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Session;

class AuthController extends Controller
{
    public function login()
    {
        return view('login');
    }

    public function register()
    {
        return view('register');
    }

    public function authentication(Request $request)
    {
        $credetials = $request->validate([
            'email' => ['required'],
            'password' => ['required'],
        ]);

        if (Auth::attempt($credetials)) {
            if (Auth::user()->status != 'active') {
                Session::flash('status', 'failed');
                Session::flash('status', 'Your account is not active. Confirm to admin!');
                return redirect('login');
            }

            if(Auth::user()->role_id == 1) {
                return redirect('admin/dashboard');
            }
            return redirect('dashboard');
        }

        Session::flash('status', 'failed');
        Session::flash('status', 'Login Invalid');
        return redirect('login');
    }
    public function logout(Request $request): RedirectResponse
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('login');
    }

}
