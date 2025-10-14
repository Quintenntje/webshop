<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\NewsLetter;

class NewsLetterController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
        ]);

        NewsLetter::create([
            'email' => $request->email,
        ]);
        return redirect()->back()->with('success', 'Newsletter subscription created successfully');
    }


    public function unsubscribe($email)
    {
        NewsLetter::where('email', $email)->delete();
        return redirect()->back()->with('success', 'Newsletter unsubscribed successfully');
    }

}
