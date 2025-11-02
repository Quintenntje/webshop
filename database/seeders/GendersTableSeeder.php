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
            [
                'name' => json_encode(['en' => 'Men', 'nl' => 'Mannen', 'fr' => 'Hommes'], JSON_UNESCAPED_UNICODE),
                'slug' => 'men'
            ],
            [
                'name' => json_encode(['en' => 'Women', 'nl' => 'Vrouwen', 'fr' => 'Femmes'], JSON_UNESCAPED_UNICODE),
                'slug' => 'women'
            ],
            [
                'name' => json_encode(['en' => 'Kids', 'nl' => 'Kinderen', 'fr' => 'Enfants'], JSON_UNESCAPED_UNICODE),
                'slug' => 'kids'
            ],
            [
                'name' => json_encode(['en' => 'Unisex', 'nl' => 'Unisex', 'fr' => 'Unisex'], JSON_UNESCAPED_UNICODE),
                'slug' => 'unisex'
            ],
        ]);
    }
}


