<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Gender;
use App\Models\ProductImage;
use App\Models\ProductVariant;
use App\Models\ProductColor;
use App\Models\ProductSize;

class ProductController extends Controller
{

    public function list()
    {

        return view(
            'products.list',
            [
                'products' => Product::paginate(10),
            ]
        );
    }

    public function listByGender($gender)
    {
        $gender = Gender::where('slug', $gender)->first();

        if (!$gender) {
            return redirect("/");
        }

        $products = Product::where('gender_id', $gender->id)->get();

        return view('products.list', [
            'gender' => $gender,
            'products' => $products->paginate(10),
        ]);
    }

    public function detail($gender, $product, Request $request)
    {
        $color_id = $request->query('color_id') ?? 1;
        $size_id = $request->query('size_id');

        $gender = Gender::where('slug', $gender)->first();
        $product = Product::where('id', $product)->first();
        $productImages = ProductImage::where('product_id', $product->id)->get();
        $productVariants = ProductVariant::where('product_id', $product->id)->get();

        $productVariants = ProductVariant::where('product_id', $product->id)->get();
        $colorIds = $productVariants->pluck('color_id')->unique();
        $allAvailableColors = ProductColor::whereIn('id', $colorIds)->get();

        $colorIdNotInStock = $productVariants->where('stock', 0)->pluck('color_id')->unique();

        $sizeIds = $productVariants->where('color_id', $color_id)->where('stock', '>', 0)->pluck('size_id')->unique();
        $allAvailableSizes = ProductSize::whereIn('id', $sizeIds)->get();

        $sizeIdNotInStock = $productVariants->where('stock', 0)->pluck('size_id')->unique();

        $productVariant = ProductVariant::where('color_id', $color_id)->where('size_id', $size_id)->where('product_id', $product->id)->first();


        if (!$product) {
            return redirect("/");
        }

        return view('products.detail', compact('gender', 'product', 'productImages', 'productVariants', 'productVariant', 'allAvailableColors', 'allAvailableSizes', 'colorIdNotInStock', 'sizeIdNotInStock', 'color_id', 'size_id'));
    }

    public function search(Request $request)
    {
        $searchQuery = $request->input('search');
        $products = Product::where('name', 'like', '%' . $searchQuery . '%')->get();
        return view('search', compact('products'));
    }
}
