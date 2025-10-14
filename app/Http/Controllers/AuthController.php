<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Customer;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function viewLogin()
    {
        return view('auth.login');
    }

    public function viewRegister()
    {
        return view('auth.register');
    }

    public function register(Request $request){
        $request->validate([
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'email' => 'required|email|unique:customers',
            'password' => 'required|string|min:8|confirmed',
        ]);
        
        Customer::create([
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role_id' => 1,
        ]);

        return redirect()->route('login')->with('success', 'Registration successful');
    }

    public function login(Request $request){

        $request->validate([
            'email' => 'required|email',
            'password' => 'required|string|min:8',
        ]);
        
        if(Auth::attempt(['email' => $request->email, 'password' => $request->password])){
            return redirect()->intended('/');
        }

        return back()->withErrors([
            'error' => 'Invalid credentials',
        ]);
    }

    public function logout(){
        Auth::logout();
        return redirect()->route('login');
    }

    public function viewAccount(){
        $user = Auth::user();
      
        return view('account.index', compact('user'));
    }
}
