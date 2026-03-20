<?php

namespace App\Http\Controllers\Public;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class LoginController extends Controller
{
    // Show the login form
    public function showLoginForm()
    {
        return view('public.login');
    }

    // Handle the login request
    public function loginProcess(Request $request)
    {
        // Input validation
        $request->validate([
            'email' => 'required|email',
            'password' => 'required|min:8',
        ], [
            'email.required' => 'Email wajib diisi!',
            'email.email' => 'Format email tidak valid!',
            'password.required' => 'Password wajib diisi!',
            'password.min' => 'Password minimal 8 karakter!',
        ]);

        // Logic to dashboard admin
        if ($request->email === 'admin@gmail.com' && $request->password === 'admin1234') {
            session(['is_admin' => true]);

            return redirect()->route('dashboardadmin')->with('success', 'Login berhasil. Selamat datang, Admin NutriCare!');
        }

        // If not admin, redirect back with error message
        return back()->withErrors(['email' => 'Akun tidak terdaftar!'])->withInput();
    }
}
