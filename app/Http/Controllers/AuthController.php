<?php

namespace App\Http\Controllers;

class AuthController extends Controller
{
    public function viewLogin()
    {
        return view('auth.login');
    }
}
