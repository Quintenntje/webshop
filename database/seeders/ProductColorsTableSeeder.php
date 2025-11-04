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
            [
                'name' => json_encode([
                    'en' => 'Orange',
                    'nl' => 'Oranje',
                    'fr' => 'Orange',
                ]),
            ],
            [
                'name' => json_encode([
                    'en' => 'Purple',
                    'nl' => 'Paars',
                    'fr' => 'Violet',
                ]),
            ],
            [
                'name' => json_encode([
                    'en' => 'Pink',
                    'nl' => 'Roze',
                    'fr' => 'Rose',
                ]),
            ],
            [
                'name' => json_encode([
                    'en' => 'Grey',
                    'nl' => 'Grijs',
                    'fr' => 'Gris',
                ]),
            ],
            [
                'name' => json_encode([
                    'en' => 'Brown',
                    'nl' => 'Bruin',
                    'fr' => 'Marron',
                ]),
            ],
            [
                'name' => json_encode([
                    'en' => 'Gold',
                    'nl' => 'Goud',
                    'fr' => 'Or',
                ]),
            ],
            [
                'name' => json_encode([
                    'en' => 'Silver',
                    'nl' => 'Zilver',
                    'fr' => 'Argent',
                ]),
            ],
            [
                'name' => json_encode([
                    'en' => 'Tan',
                    'nl' => 'Bruinachtig',
                    'fr' => 'Beige',
                ]),
            ],
            [
                'name' => json_encode([
                    'en' => 'Other',
                    'nl' => 'Anders',
                    'fr' => 'Autre',
                ]),
            ],
        ];

        DB::table('product_colors')->insert($colors);
    }
}


