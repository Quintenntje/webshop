<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Gender;
use App\Models\ProductImage;

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

    public function detail($gender, $product)
    {
        $gender = Gender::where('slug', $gender)->first();
        $product = Product::where('id', $product)->first();
        $productImages = ProductImage::where('product_id', $product->id)->get();

        if (!$product) {
            return redirect("/");
        }

        return view('products.detail', compact('gender', 'product', 'productImages'));
    }
}
