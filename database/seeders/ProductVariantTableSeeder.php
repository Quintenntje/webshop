<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProductVariantTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $productIds = DB::table('products')->pluck('id');
        $colorIds = DB::table('product_colors')->pluck('id');
        $sizeIds = DB::table('product_sizes')->pluck('id');

        foreach ($productIds as $productId) {
            foreach ($colorIds as $colorId) {
                foreach ($sizeIds as $sizeId) {
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


