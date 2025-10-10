<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class BrandsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('brands')->insert([
            [
                'name' => 'Nike',
                'slug' => 'nike',
                'image' => 'https://static.nike.com/a/images/f_auto/q_auto/dpr_2.0,cs_srgb/w_1920,c_limit/d9d0a060-8c73-41eb-a1f0-6a67702eb6b3/nike-just-do-it.png',

            ],
            [
                'name' => 'Adidas',
                'slug' => 'adidas',
                'image' => 'https://assets.adidas.com/images/w_600,f_auto,q_auto/3df9f7bb0d9f4d3f8f21ad1d00c0f1f9_9366/Adidas_Brand_Badge.png',

            ],
            [
                'name' => 'Puma',
                'slug' => 'puma',
                'image' => 'https://images.puma.com/image/upload/q_auto,f_auto/global/SVG/Logos/Puma-logo.svg',

            ],
            [
                'name' => 'New Balance',
                'slug' => 'new-balance',
                'image' => 'https://nb.scene7.com/is/image/NB/logo_nb_2019',

            ],
        ]);
    }
}


