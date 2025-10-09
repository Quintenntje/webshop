<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CategoriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('categories')->insert([
            ['name' => 'Shoes'],
            ['name' => 'Clothing'],
            ['name' => 'Accessories'],
            ['name' => 'Sportswear'],
        ]);
    }
}


