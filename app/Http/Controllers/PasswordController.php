<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Customer;
use App\Models\PasswordReset;
use Illuminate\Support\Facades\Mail;
use App\Mail\PasswordResetEmail;
use Illuminate\Support\Facades\Hash;

class PasswordController extends Controller
{
    public function viewForgotPassword()
    {
        return view('auth.forgot-password');
    }
    public function viewResetPassword(Request $request)
    {
     
        $token = $request->query('token');
        $passwordReset = PasswordReset::where('code', $token)->first();

        if (!$passwordReset) {
            return redirect()->route('forgot-password')->with('error', 'Invalid or expired reset token please request a new reset link');
        }

        if ($passwordReset->expire_time < now()) {
            return redirect()->route('forgot-password')->with('error', 'Invalid or expired reset token please request a new reset link');
        }

        return view('auth.reset-password', ['token' => $token]);
    }
    public function submitForgotPassword(Request $request)
    {
        $request->validate([
            'email' => 'required|email|exists:customers,email',
        ]);

        $customer = Customer::where('email', $request->email)->first();
        $code = rand(1000000000, 9999999999);
        $expire_time = now()->addMinutes(10);
        PasswordReset::create([
            'customer_id' => $customer->id,
            'code' => $code,
            'expire_time' => $expire_time,
        ]);
        Mail::to($customer->email)->send(new PasswordResetEmail($code));


        return redirect()->route('forgot-password')->with('success', 'Reset link sent to your email');
    }

    public function submitResetPassword(Request $request)
    {
        $request->validate([
            'password' => 'required|string|min:8|confirmed',
            'token' => 'required',
        ]);

        $passwordReset = PasswordReset::where('code', $request->token)->first();
    
        $customer = Customer::where('id', $passwordReset->customer_id)->first();

        if (!$customer) {
            return redirect()->route('forgot-password')->with('error', 'Invalid or expired reset token please request a new reset link');
        }

        $customer->password = Hash::make($request->password);
        $customer->save();
    
        $passwordReset->delete();
        return redirect()->route('login')->with('success', 'Password reset successfully');
    }
}
