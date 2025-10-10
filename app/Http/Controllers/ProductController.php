<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Gender;
use App\Models\ProductImage;
use App\Models\ProductVariant;

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
        $productVariants = ProductVariant::where('product_id', $product->id)
            ->where('color_id', 1)
            ->get();


        if (!$product) {
            return redirect("/");
        }

        return view('products.detail', compact('gender', 'product', 'productImages', 'productVariants'));
    }
}
