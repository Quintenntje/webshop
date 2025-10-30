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
        $genderSlug = $request->query('gender');

        $brand = $brandSlug ? Brand::where('slug', $brandSlug)->first() : null;
        $gender = $genderSlug ? Gender::where('slug', $genderSlug)->first() : null;

        $products = $this->buildProductQuery($request, $gender, $brand)->paginate(10);

        return view('products.list', [
            'products' => $products,
            'brands' => Brand::all(),
            'genders' => Gender::all(),
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

    
        $products = $this->buildProductQuery($request, $gender, $brand)->paginate(10);

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

    public function listByBrand($brand, Request $request)
    {
        $brand = Brand::where('slug', $brand)->first();
        $brands = Brand::all();
        $genders = Gender::all();

        if (!$brand) {
            return redirect("/");
        }
        $genderSlug = $request->query('gender');
        $gender = $genderSlug ? Gender::where('slug', $genderSlug)->first() : null;

        $products = $this->buildProductQuery($request, $gender, $brand)->paginate(10);

        SEOTools::setTitle('Shop ' . $brand->name . ' products');
        SEOTools::setDescription('Shop for all ' . $brand->name . ' products');
        SEOTools::opengraph()->setUrl(url()->current());
        SEOTools::opengraph()->setType('website');
        SEOTools::opengraph()->setDescription('Shop for all ' . $brand->name . ' products');

        return view('products.list', compact('brand', 'products', 'brands', 'genders'));
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

    public function sales(Request $request)
    {
        SEOTools::setTitle('Sales - Special Offers');
        SEOTools::setDescription('Shop discounted products and special offers');
        SEOTools::opengraph()->setUrl(url()->current());
        SEOTools::opengraph()->setType('website');
        SEOTools::opengraph()->setDescription('Shop discounted products and special offers');

        $brandSlug = $request->query('brand');
        $genderSlug = $request->query('gender');

        $brand = $brandSlug ? Brand::where('slug', $brandSlug)->first() : null;
        $gender = $genderSlug ? Gender::where('slug', $genderSlug)->first() : null;

        $query = Product::query()->whereHas('activeDiscount');
           

        if ($gender) {
            $query->where('gender_id', $gender->id);
        }

        if ($brand) {
            $query->where('brand_id', $brand->id);
        }

        $this->applySort($query, $request);

        $products = $query->paginate(10);

        return view('products.list', [
            'products' => $products,
            'brands' => Brand::all(),
            'genders' => Gender::all(),
        ]);
    }

    private function applySort($query, Request $request)
    {
        if ($request->query('sort')) {
            switch ($request->query('sort')) {
                case 'price-asc':
                    $query->orderBy('price', 'asc');
                    break;
                case 'price-desc':
                    $query->orderBy('price', 'desc');
                    break;
                case 'name-asc':
                    $query->orderBy('name', 'asc');
                    break;
                case 'name-desc':
                    $query->orderBy('name', 'desc');
                    break;
            }
        }
    }

    private function buildProductQuery(Request $request, $gender = null, $brand = null)
    {
    $query = Product::query();

        if ($gender) {
            $query->where('gender_id', $gender->id);
        }

        if ($brand) {
            $query->where('brand_id', $brand->id);
        }

        $this->applySort($query, $request);

        return $query;
    }
}
