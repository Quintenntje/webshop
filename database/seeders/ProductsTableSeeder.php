<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProductsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $brandIds = DB::table('brands')->pluck('id');
        $categoryIds = DB::table('categories')->pluck('id');
        $genderIds = DB::table('genders')->pluck('id');

        $products = [
            ['name' => 'Air Runner', 'price' => 99.99],
            ['name' => 'City Sneaker Low', 'price' => 84.99],
            ['name' => 'Trail Blazer GTX', 'price' => 129.95],
            ['name' => 'Court Classic', 'price' => 74.50],
            ['name' => 'Street Glide', 'price' => 89.90],
            ['name' => 'Ultra Boost Runner', 'price' => 159.00],
            ['name' => 'Everyday Slip-On', 'price' => 49.00],
            ['name' => 'Canvas Hi-Top', 'price' => 59.00],
            ['name' => 'Retro Jogger 90s', 'price' => 94.50],
            ['name' => 'Minimal Leather Sneaker', 'price' => 119.00],
            ['name' => 'Skate Pro Vulc', 'price' => 69.99],
            ['name' => 'Marathon Racer', 'price' => 139.99],
            ['name' => 'Kids Lightning Sneaker', 'price' => 39.99],
            ['name' => 'All-Weather Trek', 'price' => 109.99],
            ['name' => 'Plush Cloud Runner', 'price' => 129.00],
            ['name' => 'Tempo Training Shoe', 'price' => 89.00],
            ['name' => 'Court Luxe Women', 'price' => 99.00],
            ['name' => 'Prime Knit Slip', 'price' => 89.50],
            ['name' => 'Stability Road Pro', 'price' => 149.00],
            ['name' => 'Classic Suede', 'price' => 79.00],
        ];

        foreach ($products as $product) {
            DB::table('products')->insert([
                'name' => $product['name'],
                'price' => $product['price'],
                'gender_id' => $genderIds->random(),
                'brand_id' => $brandIds->random(),
                'category_id' => $categoryIds->random(),
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}


