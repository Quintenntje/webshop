<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Gender;

class ProductController extends Controller
{

    public function list($gender)
    {
        $gender = Gender::where('slug', $gender)->first();

        if (!$gender) {
            return redirect("/");
        }

        $products = Product::where('gender_id', $gender->id)->get();

        return view('products.list', compact('gender', 'products'));
    }
}
