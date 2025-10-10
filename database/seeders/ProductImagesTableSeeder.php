<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProductImagesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $products = DB::table('products')->select('id', 'name')->get();
        $colorIds = DB::table('product_colors')->pluck('id');

        foreach ($products as $product) {
            $primaryColorId = $colorIds->random();

            $urls = $this->getImageUrlsForName($product->name);
            $primaryUrl = $urls[0];

            DB::table('product_images')->insert([
                'filename' => $primaryUrl, // storing full URL
                'product_id' => $product->id,
                'color_id' => $primaryColorId,
                'is_primary' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            $extraCount = min(random_int(0, 2), max(0, count($urls) - 1));
            for ($i = 1; $i <= $extraCount; $i++) {
                DB::table('product_images')->insert([
                    'filename' => $urls[$i],
                    'product_id' => $product->id,
                    'color_id' => $colorIds->random(),
                    'is_primary' => false,
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
            }
        }
    }

    private function getImageUrlsForName(string $name): array
    {
        $map = [
            'Ultra Boost' => [
                'https://assets.adidas.com/images/w_600,f_auto,q_auto/9d3d9c9b17a64f8db3c7ad3a014c0d4c_9366/Ultraboost_Light_Schoenen_zwart_GY9350_01_standard.jpg',
                'https://assets.adidas.com/images/w_600,f_auto,q_auto/0db5b6c5d2cb4f4f9d1ead3a014c0e4c_9366/Ultraboost_Light_Schoenen_zwart_GY9350_02_standard_hover.jpg',
            ],
            'Air Runner' => [
                'https://static.nike.com/a/images/t_PDP_1280_v1/f_auto,q_auto:eco/3a6e2c9b-7b7d-4e4d-a0c9-0a6d6a1d6a9f/air-pegasus-40-hardloopschoenen.png',
                'https://static.nike.com/a/images/t_PDP_1280_v1/f_auto,q_auto:eco/8e8a1d2a-3b6a-4a7d-bb33-9a1b4b1f2b46/air-pegasus-40-hardloopschoenen.png',
            ],
            'Trail Blazer' => [
                'https://images.thenorthface.com/is/image/TheNorthFaceEU/7W5V_JK3_hero',
            ],
            'Court Classic' => [
                'https://static.nike.com/a/images/t_PDP_1280_v1/f_auto,q_auto:eco/f5c1b2f4-1b58-4c7d-8768-1db44c7a4d5c/court-vision-low-schoenen.png',
            ],
            'Minimal Leather' => [
                'https://images.pexels.com/photos/2529148/pexels-photo-2529148.jpeg',
            ],
            'Canvas Hi-Top' => [
                'https://images.ctfassets.net/1es3ne0caaid/5y6S4i3RG7g4s0Gx6O1R2N/8b8c2a9df3e9c7b7c1f6e2d2d1a5f3e4/CT_High_Black.png',
            ],
            'Skate Pro' => [
                'https://images.vans.com/is/image/VansEU/VN0A5JIA187-HERO',
            ],
            'Retro Jogger' => [
                'https://newbalance-be.scene7.com/is/image/NB/ml574evg_nb_02_i?$pdpflexf2$',
            ],
        ];

        foreach ($map as $keyword => $urls) {
            if (stripos($name, $keyword) !== false) {
                return $urls;
            }
        }

        // fallback: generic sneaker images from Unsplash
        return [
            'https://images.unsplash.com/photo-1542291026-7eec264c27ff?q=80&w=1200',
            'https://images.unsplash.com/photo-1528701800489-20be3c2ea5f4?q=80&w=1200',
            'https://images.unsplash.com/photo-1525966222134-fcfa99b8ae77?q=80&w=1200',
        ];
    }
}


