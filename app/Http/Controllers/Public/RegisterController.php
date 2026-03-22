<?php

namespace App\Http\Controllers\Public;

use App\Http\Controllers\Controller;

class RegisterController extends Controller
{
    // Show the register form
    public function showRegisterForm()
    {
        return view('public.register');
    }
}
