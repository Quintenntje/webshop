<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Gender;
use App\Models\ProductImage;
use App\Models\ProductVariant;
use App\Models\ProductColor;
use App\Models\ProductSize;
use App\Models\Brand;
use Artesaos\SEOTools\Facades\SEOTools;

class ProductController extends Controller
{

    public function list(Request $request)
    {

        SEOTools::setTitle('Shop');
        SEOTools::setDescription('Shop for all products');
        SEOTools::opengraph()->setUrl(url()->current());
        SEOTools::opengraph()->setType('website');
        SEOTools::opengraph()->setDescription('Shop for all products');

        $brandSlug = $request->query('brand');

        $brand = $brandSlug ? Brand::where('slug', $brandSlug)->first() : null;

        $products = $brandSlug
            ? Product::where('brand_id', $brand->id)->paginate(10)
            : Product::paginate(10);

        return view('products.list', [
            'products' => $products,
            'brands' => Brand::all(),
        ]);

    }

    public function listByGender($gender, Request $request)
    {

        $gender = Gender::where('slug', $gender)->first();

        if (!$gender) {
            return redirect("/");
        }

        $brands = Brand::all();
        $brandSlug = $request->query('brand');

        $brand = $brandSlug ? Brand::where('slug', $brandSlug)->first() : null;

        $products = $brandSlug
            ? Product::where('gender_id', $gender->id)
                ->where('brand_id', $brand->id)
                ->paginate(10)
            : Product::where('gender_id', $gender->id)->paginate(10);


        SEOTools::setTitle('Shop ' . $gender->name . ' products');
        SEOTools::setDescription('Shop for all ' . $gender->name . ' products');
        SEOTools::opengraph()->setUrl(url()->current());
        SEOTools::opengraph()->setType('website');
        SEOTools::opengraph()->setDescription('Shop for all ' . $gender->name . ' products');

        return view('products.list', [
            'gender' => $gender,
            'products' => $products,
            'brands' => $brands,
        ]);
    }

    public function listByBrand($brand)
    {
        $brand = Brand::where('slug', $brand)->first();
        $brands = Brand::all();

        if (!$brand) {
            return redirect("/");
        }

        $products = Product::where('brand_id', $brand->id)->paginate(10);

        SEOTools::setTitle('Shop ' . $brand->name . ' products');
        SEOTools::setDescription('Shop for all ' . $brand->name . ' products');
        SEOTools::opengraph()->setUrl(url()->current());
        SEOTools::opengraph()->setType('website');
        SEOTools::opengraph()->setDescription('Shop for all ' . $brand->name . ' products');

        return view('products.list', compact('brand', 'products', 'brands'));
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

        SEOTools::setTitle($product->name);
        SEOTools::setDescription($product->description);
        SEOTools::opengraph()->setUrl(url()->current());
        SEOTools::opengraph()->setType('website');
        SEOTools::opengraph()->setDescription($product->description);

        return view('products.detail', compact('gender', 'product', 'productImages', 'productVariants', 'productVariant', 'allAvailableColors', 'allAvailableSizes', 'colorIdNotInStock', 'sizeIdNotInStock', 'color_id', 'size_id'));
    }

    public function search(Request $request)
    {
        $searchQuery = $request->input('search');
        $products = Product::where('name', 'like', '%' . $searchQuery . '%')->get();
        return view('search', compact('products'));
    }


}
