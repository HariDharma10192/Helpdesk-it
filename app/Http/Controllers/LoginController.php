<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class LoginController extends Controller
{
    public function index()
    {
        // Jika pengguna sudah login, redirect ke halaman sesuai peran
        if (Auth::check()) {
            $user = Auth::user();
            if ($user->role_id == 1) {
                return redirect('/Admin/main');
            } elseif ($user->role_id == 3) {
                return redirect('/dept');
            } else {
                return redirect('/main');
            }
        }

        return view('login.index');
    }
    public function authenticate(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();

            // Get the authenticated user
            $user = Auth::user();

            // Check the role_id and redirect accordingly
            if ($user->role_id == 1) {
                return redirect('/Admin/main');
            } elseif ($user->role_id == 3) {
                return redirect('/dept');
            } else {
                return redirect()->intended('/complaints');
            }
        }

        return back()->with('loginError', 'Login failed! Please check your email and password');
    }



    public function logout()
    {
        Auth::logout();
        request()->session()->invalidate();
        request()->session()->regenerateToken();
        return redirect('/login');
    }
}
