<?php

namespace App\Http\Controllers\Public;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class HomePublicController extends Controller
{
    public function HomePublic()
    {
        return view('public.home');
    }
}
