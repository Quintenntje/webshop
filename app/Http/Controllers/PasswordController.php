<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Customer;
use App\Models\PasswordReset;
class PasswordController extends Controller
{
    public function viewForgotPassword()
    {
        return view('auth.forgot-password');
    }
    public function submitForgotPassword(Request $request)
    {
        $request->validate([
            'email' => 'required|email|exists:customers,email',
        ]);

        $customer = Customer::where('email', $request->email)->first();
        $code = rand(100000, 999999);
        $expire_time = now()->addMinutes(10);
        PasswordReset::create([
            'customer_id' => $customer->id,
            'code' => $code,
            'expire_time' => $expire_time,
        ]);

        

        return redirect()->route('forgot-password')->with('success', 'Reset link sent to your email');
    }
}
