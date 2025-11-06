<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class NikeExtraProductsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $brandId = DB::table('brands')->where('slug', 'nike')->value('id');
        $genderId = DB::table('genders')->where('slug', 'men')->value('id');

        if (!$brandId || !$genderId) {
            return; // prerequisites missing
        }

        $products = [
            [
                'name' => 'Air Force 1 GTX Vibram',
                'price' => '150',
                'description' => "The AF1 has always been a rugged shoe, but we're takin' it to the next level. The all leather upper sits atop a waterproof GORE-TEX membrane that helps protect you against rain, sleet and snow. Beneath that you got a Vibram sole designed to help you brave every wet, slippery and cold surface. Best winter ever?",
                'colors' => [
                    'white' => [
                        'images' => [
                            'https://static.nike.com/a/images/t_default/a97aaeee-e955-4d22-b1e7-cab21b246b6b/AIR+FORCE+1+GTX+VIBRAM.png',
                            'https://static.nike.com/a/images/t_default/c8d379ea-473e-4882-a417-ca6aaa4ffd50/AIR+FORCE+1+GTX+VIBRAM.png',
                            'https://static.nike.com/a/images/t_default/55c93040-ee57-4faf-9b30-1b09c0ae49d0/AIR+FORCE+1+GTX+VIBRAM.png',
                            'https://static.nike.com/a/images/t_default/e3bb7ab7-6e50-441c-99e9-538b92b429d1/AIR+FORCE+1+GTX+VIBRAM.png',
                        ],
                    ],
                    'green' => [
                        'images' => [
                            'https://static.nike.com/a/images/t_default/70990dd9-d79e-4f2d-8c98-dc50569ac5a6/AIR+FORCE+1+GTX+VIBRAM.png',
                            'https://static.nike.com/a/images/t_default/944db821-7d9d-492d-b5b7-8c341897a1c6/AIR+FORCE+1+GTX+VIBRAM.png',
                            'https://static.nike.com/a/images/t_default/2bd1dc17-5f50-475a-990c-b3252e4dc4a8/AIR+FORCE+1+GTX+VIBRAM.png',
                            'https://static.nike.com/a/images/t_default/80b6918c-17f7-471a-8948-f5dc282bc7bd/AIR+FORCE+1+GTX+VIBRAM.png',
                        ],
                    ],
                    'black' => [
                        'images' => [
                            'https://static.nike.com/a/images/t_default/97b48652-54ae-401e-969d-a2e799f98101/AIR+FORCE+1+GTX+VIBRAM.png',
                            'https://static.nike.com/a/images/t_default/489abb99-6895-45af-86ba-8fef00d3911a/AIR+FORCE+1+GTX+VIBRAM.png',
                            'https://static.nike.com/a/images/t_default/9cc994b4-37c6-4465-b60d-c2835f91c40f/AIR+FORCE+1+GTX+VIBRAM.png',
                            'https://static.nike.com/a/images/t_default/9ecc0663-6b47-4cfd-a5aa-6edba57a6c17/AIR+FORCE+1+GTX+VIBRAM.png',
                        ],
                    ],
                ],
            ],
            [
                'name' => 'Nike Air Max 90',
                'price' => '135',
                'description' => 'Lace up and feel the legacy. Produced at the intersection of art, music and culture, this champion running shoe helped define the ‘90s. Worn by presidents, revolutionized through collabs and celebrated through rare colorways, its striking visuals, Waffle outsole, and exposed Air cushioning keep it alive and well.',
                'colors' => [
                    'black' => [
                        'images' => [
                            'https://static.nike.com/a/images/t_default/w2ldynwtyuspv6r5rffj/AIR+MAX+90.png',
                            'https://static.nike.com/a/videos/so_0.66/d94727f8-37d4-4964-a4c2-a54fe7565909/AIR+MAX+90.jpg',
                            'https://static.nike.com/a/images/t_default/njrzuhkcnrtmxrh7qrqr/AIR+MAX+90.png',
                            'https://static.nike.com/a/images/t_default/ma6tfbsbasqhmsjo9zyx/AIR+MAX+90.png',
                        ],
                    ],
                    'blue' => [
                        'images' => [
                            'https://static.nike.com/a/images/t_default/f38f6999-8e23-4bfd-801f-823dbf7ca2f7/AIR+MAX+90.png',
                            'https://static.nike.com/a/images/t_default/886014ca-9151-4fed-81ac-8c089e215e11/AIR+MAX+90.png',
                            'https://static.nike.com/a/images/t_default/b598354d-0903-4183-9077-17ba0c832227/AIR+MAX+90.png',
                            'https://static.nike.com/a/images/t_default/c0bb5caf-6310-4eed-89cd-41fc9c215663/AIR+MAX+90.png',
                        ],
                    ],
                    'orange' => [
                        'images' => [
                            'https://static.nike.com/a/images/t_default/f0fded68-db96-4381-aabd-3b3469511f0f/AIR+MAX+90.png',
                            'https://static.nike.com/a/images/t_default/d9d20854-8795-44ff-a7d3-cc371a9b46ee/AIR+MAX+90.png',
                            'https://static.nike.com/a/images/t_default/c257c95c-2492-4952-9c7d-c734553a01c8/AIR+MAX+90.png',
                            'https://static.nike.com/a/images/t_default/a5119cc5-fbc1-4e46-9520-ceea258bdd80/AIR+MAX+90.png',
                        ],
                    ],
                    'purple' => [
                        'images' => [
                            'https://static.nike.com/a/images/t_default/5e8ad440-257f-4b67-a74d-2ab01e23787c/AIR+MAX+90.png',
                            'https://static.nike.com/a/images/t_default/6238a8c4-b805-4ecd-a040-98076dbf64f5/AIR+MAX+90.png',
                            'https://static.nike.com/a/images/t_default/db97b63b-c835-40cd-b97f-319bac0c7752/AIR+MAX+90.png',
                            'https://static.nike.com/a/images/t_default/404d2750-ecd1-4a22-a04c-3dbf847b60ff/AIR+MAX+90.png',
                        ],
                    ],
                ],
            ],
        ];

        foreach ($products as $productData) {
            $productId = DB::table('products')
                ->where('name', $productData['name'])
                ->where('brand_id', $brandId)
                ->value('id');

            if (!$productId) {
                $productId = DB::table('products')->insertGetId([
                    'name' => $productData['name'],
                    'price' => (float) $productData['price'],
                    'description' => json_encode([
                        'en' => $productData['description'],
                        'nl' => $productData['description'],
                        'fr' => $productData['description'],
                    ], JSON_UNESCAPED_UNICODE),
                    'gender_id' => $genderId,
                    'brand_id' => $brandId,
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
            }

            $hasPrimary = DB::table('product_images')->where('product_id', $productId)->where('is_primary', true)->exists();

            foreach ($productData['colors'] as $colorKey => $payload) {
                $colorId = $this->getColorIdFor($colorKey);
                if (!$colorId) {
                    continue;
                }

                $images = $payload['images'] ?? [];
                foreach ($images as $idx => $url) {
                    $exists = DB::table('product_images')
                        ->where('product_id', $productId)
                        ->where('filename', $url)
                        ->exists();
                    if ($exists) {
                        continue;
                    }
                    DB::table('product_images')->insert([
                        'filename' => $url,
                        'product_id' => $productId,
                        'color_id' => $colorId,
                        'is_primary' => $hasPrimary ? false : $idx === 0,
                        'created_at' => now(),
                        'updated_at' => now(),
                    ]);
                }

                if (!$hasPrimary && !empty($images)) {
                    $hasPrimary = true;
                }
            }
        }
    }

    private function getColorIdFor(string $colorKey): ?int
    {
        $map = [
            'white' => ['en' => 'White', 'nl' => 'Wit', 'fr' => 'Blanc'],
            'black' => ['en' => 'Black', 'nl' => 'Zwart', 'fr' => 'Noir'],
            'green' => ['en' => 'Green', 'nl' => 'Groen', 'fr' => 'Vert'],
            'blue'  => ['en' => 'Blue',  'nl' => 'Blauw', 'fr' => 'Bleu'],
            'orange'=> ['en' => 'Orange','nl' => 'Oranje','fr' => 'Orange'],
            'purple'=> ['en' => 'Purple','nl' => 'Paars', 'fr' => 'Violet'],
        ];

        $localeNames = $map[strtolower($colorKey)] ?? null;
        if (!$localeNames) {
            return null;
        }

        $rows = DB::table('product_colors')->select('id', 'name')->get();
        foreach ($rows as $row) {
            $names = json_decode($row->name, true) ?: [];
            if (isset($names['en']) && strcasecmp($names['en'], $localeNames['en']) === 0) {
                return (int) $row->id;
            }
        }

        return DB::table('product_colors')->insertGetId([
            'name' => json_encode($localeNames, JSON_UNESCAPED_UNICODE),
        ]);
    }
}


