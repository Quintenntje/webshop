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
            ['name' => 'Street Hoodie', 'price' => 59.95],
            ['name' => 'Classic Tee', 'price' => 24.50],
            ['name' => 'Training Shorts', 'price' => 34.90],
            ['name' => 'Everyday Backpack', 'price' => 49.00],
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


