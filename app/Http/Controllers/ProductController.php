<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Gender;
use App\Models\Brand;
use Artesaos\SEOTools\Facades\SEOTools;
use Artesaos\SEOTools\Facades\JsonLd;

class ProductController extends Controller
{
    public function list(Request $request)
    {
        SEOTools::setTitle(__('seo.shop.title'));
        SEOTools::setDescription(__('seo.shop.description'));
        SEOTools::opengraph()->setUrl(url()->current());
        SEOTools::opengraph()->setType('website');
        SEOTools::opengraph()->setDescription(__('seo.shop.description'));

        JsonLd::addValue([
            '@context' => 'https://schema.org',
            '@type' => 'WebPage',
            'name' => __('seo.shop.title'),
            'description' => __('seo.shop.description'),
            'url' => url()->current(),
        ]);

        $brandSlug = $request->query('brand');
        $genderSlug = $request->query('gender');

        $brand = $brandSlug ? Brand::where('slug', $brandSlug)->first() : null;
        $gender = $genderSlug ? Gender::where('slug', $genderSlug)->first() : null;

        $products = $this->buildProductQuery($request, $gender, $brand)->paginate(25);

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
            return redirect("/not_found");
        }

        $brands = Brand::all();
        $brandSlug = $request->query('brand');

        $brand = $brandSlug ? Brand::where('slug', $brandSlug)->first() : null;


        $products = $this->buildProductQuery($request, $gender, $brand)->paginate(25);

        SEOTools::setTitle(__('seo.shop_gender.title', ['gender' => $gender->name]));
        SEOTools::setDescription(__('seo.shop_gender.description', ['gender' => $gender->name]));
        SEOTools::opengraph()->setUrl(url()->current());
        SEOTools::opengraph()->setType('website');
        SEOTools::opengraph()->setDescription(__('seo.shop_gender.description', ['gender' => $gender->name]));

        JsonLd::addValue([
            '@context' => 'https://schema.org',
            '@type' => 'WebPage',
            'name' => __('seo.shop_gender.title', ['gender' => $gender->name]),
            'description' => __('seo.shop_gender.description', ['gender' => $gender->name]),
            'url' => url()->current(),
        ]);

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
            return redirect("/not_found");
        }
        $genderSlug = $request->query('gender');
        $gender = $genderSlug ? Gender::where('slug', $genderSlug)->first() : null;

        $products = $this->buildProductQuery($request, $gender, $brand)->paginate(25);

        SEOTools::setTitle(__('seo.shop_brand.title', ['brand' => $brand->name]));
        SEOTools::setDescription(__('seo.shop_brand.description', ['brand' => $brand->name]));
        SEOTools::opengraph()->setUrl(url()->current());
        SEOTools::opengraph()->setType('website');
        SEOTools::opengraph()->setDescription(__('seo.shop_brand.description', ['brand' => $brand->name]));

        JsonLd::addValue([
            '@context' => 'https://schema.org',
            '@type' => 'WebPage',
            'name' => __('seo.shop_brand.title', ['brand' => $brand->name]),
            'description' => __('seo.shop_brand.description', ['brand' => $brand->name]),
            'url' => url()->current(),
        ]);

        return view('products.list', compact('brand', 'products', 'brands', 'genders'));
    }

    public function detail($gender, $product, Request $request)
    {
        $gender = Gender::where('slug', $gender)->first();
        $product = Product::with(['variants', 'images', 'gender', 'brand', 'primaryImage'])
            ->where('slug', $product)
            ->first();

        if (!$product || !$gender) {
            return redirect("/not_found");
        }

        $color_id = $request->query('color_id') ?? $product->variants->first()->color_id ?? 1;
        $size_id = $request->query('size_id');

        $allAvailableColors = $product->getAvailableColors();

        $allAvailableSizes = $product->getAvailableSizesForColor($color_id)
            ->map(function ($size) use ($product, $color_id, $size_id) {
                $size->isInStock = $product->isSizeInStockForColor($color_id, $size->id);
                $size->isActive = $size->id == $size_id;
                return $size;
            });

        $productVariant = $product->getVariantByColorAndSize($color_id, $size_id);


        $productImages = $product->images()->where('color_id', $color_id)->get();

        $primaryImage = $productImages->where('is_primary', true)->first()
            ?? $productImages->first()
            ?? $product->primaryImage;

        SEOTools::setTitle($product->name);
        SEOTools::setDescription($product->description);
        SEOTools::opengraph()->setUrl(url()->current());
        SEOTools::opengraph()->setType('website');
        SEOTools::opengraph()->setDescription($product->description);

        // Schema.org Product
        $productPrice = $product->hasActiveDiscount() ? $product->final_price : $product->price;
        $isInStock = $productVariant && $productVariant->inStock();

        JsonLd::addValue([
            '@context' => 'https://schema.org',
            '@type' => 'Product',
            'name' => $product->name,
            'description' => $product->description,
            'image' => $primaryImage ? asset($primaryImage->filename) : null,
            'brand' => [
                '@type' => 'Brand',
                'name' => $product->brand->name,
            ],
            'offers' => [
                '@type' => 'Offer',
                'price' => $productPrice,
                'priceCurrency' => 'EUR',
                'availability' => $isInStock ? 'https://schema.org/InStock' : 'https://schema.org/OutOfStock',
            ],
        ]);

        return view('products.detail', compact(
            'gender',
            'product',
            'allAvailableColors',
            'allAvailableSizes',
            'productVariant',
            'productImages',
            'primaryImage',
            'color_id',
            'size_id'
        ));
    }

    public function search(Request $request)
    {

        SEOTools::setTitle(__('seo.search.title'));
        SEOTools::setDescription(__('seo.search.description'));
        SEOTools::opengraph()->setUrl(url()->current());
        SEOTools::opengraph()->setType('website');
        SEOTools::opengraph()->setDescription(__('seo.search.description'));

        JsonLd::addValue([
            '@context' => 'https://schema.org',
            '@type' => 'WebPage',
            'name' => __('seo.search.title'),
            'description' => __('seo.search.description'),
            'url' => url()->current(),
        ]);

        $searchQuery = $request->input('search');
        $products = Product::where('name', 'like', '%' . $searchQuery . '%')->get();
        return view('search', compact('products'));
    }

    public function sales(Request $request)
    {
        SEOTools::setTitle(__('seo.sales.title'));
        SEOTools::setDescription(__('seo.sales.description'));
        SEOTools::opengraph()->setUrl(url()->current());
        SEOTools::opengraph()->setType('website');
        SEOTools::opengraph()->setDescription(__('seo.sales.description'));

        JsonLd::addValue([
            '@context' => 'https://schema.org',
            '@type' => 'WebPage',
            'name' => __('seo.sales.title'),
            'description' => __('seo.sales.description'),
            'url' => url()->current(),
        ]);

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

        $products = $query->paginate(25);

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
