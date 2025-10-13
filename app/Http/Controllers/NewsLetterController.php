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
            'signup' => true,
        ]);
        return redirect()->back()->with('success', 'Newsletter subscription created successfully');
    }


}
