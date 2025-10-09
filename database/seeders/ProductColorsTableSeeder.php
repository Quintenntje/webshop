<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProductColorsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('product_colors')->insert([
            ['name' => 'Black'],
            ['name' => 'White'],
            ['name' => 'Red'],
            ['name' => 'Blue'],
            ['name' => 'Green'],
        ]);
    }
}


