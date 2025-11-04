<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProductSizesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // EU shoe sizes from 35 to 47
        $sizes = [];
        for ($size = 35; $size <= 47; $size++) {
            $sizes[] = ['name' => (string)$size];
        }

        DB::table('product_sizes')->insert($sizes);
    }
}


