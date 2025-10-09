<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class GendersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('genders')->insert([
            ['name' => 'Men'],
            ['name' => 'Women'],
            ['name' => 'Unisex'],
            ['name' => 'Kids'],
        ]);
    }
}


