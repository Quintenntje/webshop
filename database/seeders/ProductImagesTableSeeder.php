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
        $productIds = DB::table('products')->pluck('id');
        $colorIds = DB::table('product_colors')->pluck('id');

        foreach ($productIds as $productId) {
            $primaryColorId = $colorIds->random();
            // primary image
            DB::table('product_images')->insert([
                'filename' => 'product_' . $productId . '_primary.jpg',
                'product_id' => $productId,
                'color_id' => $primaryColorId,
                'is_primary' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            // one or two extra images
            $extraCount = random_int(0, 2);
            for ($i = 1; $i <= $extraCount; $i++) {
                DB::table('product_images')->insert([
                    'filename' => 'product_' . $productId . '_extra_' . $i . '.jpg',
                    'product_id' => $productId,
                    'color_id' => $colorIds->random(),
                    'is_primary' => false,
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
            }
        }
    }
}


