<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;

class JsonProductsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Load JSON files
        $productsJson = File::get(base_path('products.json'));
        $kicksJson = File::get(base_path('kicks.json'));

        $products = json_decode($productsJson, true);
        $kicks = json_decode($kicksJson, true);

        // Combine both arrays
        $allProducts = array_merge($products, $kicks);

        // Get lookup data
        $brands = DB::table('brands')->pluck('id', 'slug');
        $genders = DB::table('genders')->pluck('id', 'slug');
        $categories = DB::table('categories')->pluck('id', 'name');
        $colors = DB::table('product_colors')->get()->mapWithKeys(function ($color) {
            $nameData = json_decode($color->name, true);
            return [strtolower($nameData['en']) => (int) $color->id];
        })->toArray();
        $sizes = DB::table('product_sizes')->pluck('id');

        // Get category ID (default to 'Shoes')
        $categoryId = $categories->get('Shoes', $categories->first());

        foreach ($allProducts as $productData) {
            // Skip if missing required fields
            if (empty($productData['title']) || empty($productData['brand'])) {
                continue;
            }

            // Get brand ID
            $brandSlug = strtolower($productData['brand']);
            $brandId = $brands->get($brandSlug);

            if (!$brandId) {
                // Create brand if it doesn't exist
                $brandId = DB::table('brands')->insertGetId([
                    'name' => ucfirst($productData['brand']),
                    'slug' => $brandSlug,
                    'image' => null,
                ]);
                $brands->put($brandSlug, $brandId);
            }

            // Get gender ID
            $genderSlug = strtolower($productData['gender'] ?? 'unisex');
            $genderId = $genders->get($genderSlug, $genders->get('unisex'));

            // Get price from first color variant
            $firstColorKey = null;
            $firstColorData = null;
            foreach ($productData as $key => $value) {
                if (is_array($value) && isset($value[0]['price'])) {
                    $firstColorKey = $key;
                    $firstColorData = $value[0];
                    break;
                }
            }

            if (!$firstColorData) {
                continue;
            }

            // Extract price (remove $, €, commas)
            $price = preg_replace('/[^0-9.]/', '', $firstColorData['price']);
            $price = (float) $price;

            // Get description and ensure it has all translations
            $description = $this->ensureDescriptionTranslations($firstColorData['description'] ?? '');

            // Check if product already exists
            $productId = DB::table('products')
                ->where('name', $productData['title'])
                ->where('brand_id', $brandId)
                ->value('id');

            if (!$productId) {
                // Create product
                $productId = DB::table('products')->insertGetId([
                    'name' => $productData['title'],
                    'price' => $price,
                    'description' => json_encode($description, JSON_UNESCAPED_UNICODE),
                    'gender_id' => $genderId,
                    'brand_id' => $brandId,
                    'category_id' => $categoryId,
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
            } else {
                // Update existing product description if it doesn't have all translations
                $existingProduct = DB::table('products')->where('id', $productId)->first();
                $existingDescription = json_decode($existingProduct->description, true);

                if (!isset($existingDescription['en']) || !isset($existingDescription['nl']) || !isset($existingDescription['fr'])) {
                    DB::table('products')
                        ->where('id', $productId)
                        ->update([
                            'description' => json_encode($description, JSON_UNESCAPED_UNICODE),
                            'updated_at' => now(),
                        ]);
                }
            }

            // Check if product already has a primary image
            $hasPrimaryImage = DB::table('product_images')
                ->where('product_id', $productId)
                ->where('is_primary', true)
                ->exists();

            // Process each color variant
            $isFirstColor = true;
            foreach ($productData as $colorKey => $colorVariants) {
                // Skip non-color keys
                if (!in_array($colorKey, ['title', 'brand', 'gender']) && is_array($colorVariants) && isset($colorVariants[0])) {
                    $colorVariantData = $colorVariants[0];

                    // Normalize color key (handle gray/grey, etc.)
                    $normalizedColorKey = $this->normalizeColorKey($colorKey);

                    // Get or create color
                    $colorId = $colors[$normalizedColorKey] ?? null;

                    if (!$colorId) {
                        // Create color
                        $colorTranslations = $this->getColorTranslations($normalizedColorKey);
                        $colorId = DB::table('product_colors')->insertGetId([
                            'name' => json_encode($colorTranslations, JSON_UNESCAPED_UNICODE),
                        ]);
                        $colors[$normalizedColorKey] = $colorId;
                    }

                    // Get images
                    $images = $colorVariantData['images'] ?? [];

                    if (empty($images)) {
                        $isFirstColor = false;
                        continue;
                    }

                    // Insert images (first image of first color is primary)
                    foreach ($images as $index => $imageUrl) {
                        // Skip if image already exists
                        $exists = DB::table('product_images')
                            ->where('product_id', $productId)
                            ->where('filename', $imageUrl)
                            ->exists();

                        if (!$exists) {
                            $isPrimary = !$hasPrimaryImage && $isFirstColor && $index === 0;

                            DB::table('product_images')->insert([
                                'filename' => $imageUrl,
                                'product_id' => $productId,
                                'color_id' => $colorId,
                                'is_primary' => $isPrimary,
                                'created_at' => now(),
                                'updated_at' => now(),
                            ]);

                            if ($isPrimary) {
                                $hasPrimaryImage = true;
                            }
                        }
                    }

                    $isFirstColor = false;

                    // Create variants for all sizes with this color
                    foreach ($sizes as $sizeId) {
                        // Check if variant already exists
                        $variantExists = DB::table('product_variants')
                            ->where('product_id', $productId)
                            ->where('color_id', $colorId)
                            ->where('size_id', $sizeId)
                            ->exists();

                        if (!$variantExists) {
                            DB::table('product_variants')->insert([
                                'product_id' => $productId,
                                'color_id' => $colorId,
                                'size_id' => $sizeId,
                                'stock' => random_int(0, 15),
                                'created_at' => now(),
                                'updated_at' => now(),
                            ]);
                        }
                    }
                }
            }
        }
    }

    private function normalizeColorKey(string $key): string
    {
        $key = strtolower(trim($key));

        // Handle variations
        $normalizations = [
            'gray' => 'grey',
        ];

        return $normalizations[$key] ?? $key;
    }

    private function ensureDescriptionTranslations(string $description): array
    {
        // Clean description (handle HTML entities and tags)
        $description = trim($description);

        // Ensure all three language keys exist
        return [
            'en' => $description ?: '',
            'nl' => $description ?: '',
            'fr' => $description ?: '',
        ];
    }

    private function getColorTranslations(string $colorKey): array
    {
        $translations = [
            'black' => ['en' => 'Black', 'nl' => 'Zwart', 'fr' => 'Noir'],
            'white' => ['en' => 'White', 'nl' => 'Wit', 'fr' => 'Blanc'],
            'red' => ['en' => 'Red', 'nl' => 'Rood', 'fr' => 'Rouge'],
            'blue' => ['en' => 'Blue', 'nl' => 'Blauw', 'fr' => 'Bleu'],
            'green' => ['en' => 'Green', 'nl' => 'Groen', 'fr' => 'Vert'],
            'orange' => ['en' => 'Orange', 'nl' => 'Oranje', 'fr' => 'Orange'],
            'purple' => ['en' => 'Purple', 'nl' => 'Paars', 'fr' => 'Violet'],
            'pink' => ['en' => 'Pink', 'nl' => 'Roze', 'fr' => 'Rose'],
            'grey' => ['en' => 'Grey', 'nl' => 'Grijs', 'fr' => 'Gris'],
            'brown' => ['en' => 'Brown', 'nl' => 'Bruin', 'fr' => 'Marron'],
            'gold' => ['en' => 'Gold', 'nl' => 'Goud', 'fr' => 'Or'],
            'silver' => ['en' => 'Silver', 'nl' => 'Zilver', 'fr' => 'Argent'],
            'tan' => ['en' => 'Tan', 'nl' => 'Bruinachtig', 'fr' => 'Beige'],
            'other' => ['en' => 'Other', 'nl' => 'Anders', 'fr' => 'Autre'],
        ];

        return $translations[$colorKey] ?? ['en' => ucfirst($colorKey), 'nl' => ucfirst($colorKey), 'fr' => ucfirst($colorKey)];
    }
}

