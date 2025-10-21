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
                'image' => 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcRaIt87Zqn4FxDJpbJ_MOCDvQ1Crt4spIsyzQ&s'
            ],
            [
                'name' => 'Adidas',
                'slug' => 'adidas',
                'image' => 'https://download.logo.wine/logo/Adidas/Adidas-Logo.wine.png'

            ],
            [
                'name' => 'Puma',
                'slug' => 'puma',
                'image' => 'https://logos-world.net/wp-content/uploads/2020/04/Puma-Logo.png',

            ],
            [
                'name' => 'New Balance',
                'slug' => 'new-balance',
                'image' => 'https://i.pinimg.com/736x/14/84/5b/14845b86bbe8bd34dd8cd12afac5dd21.jpg'
            ],
        ]);
    }
}


