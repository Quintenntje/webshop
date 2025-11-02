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
        $colors = [
            [
                'name' => json_encode([
                    'en' => 'Black',
                    'nl' => 'Zwart',
                    'fr' => 'Noir',
                ]),
            ],
            [
                'name' => json_encode([
                    'en' => 'White',
                    'nl' => 'Wit',
                    'fr' => 'Blanc',
                ]),
            ],
            [
                'name' => json_encode([
                    'en' => 'Red',
                    'nl' => 'Rood',
                    'fr' => 'Rouge',
                ]),
            ],
            [
                'name' => json_encode([
                    'en' => 'Blue',
                    'nl' => 'Blauw',
                    'fr' => 'Bleu',
                ]),
            ],
            [
                'name' => json_encode([
                    'en' => 'Green',
                    'nl' => 'Groen',
                    'fr' => 'Vert',
                ]),
            ],
        ];

        DB::table('product_colors')->insert($colors);
    }
}


