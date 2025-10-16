<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // optional demo user
        if (!DB::table('users')->where('email', 'test@example.com')->exists()) {
            User::factory()->create([
                'name' => 'Test User',
                'email' => 'test@example.com',
            ]);
        }

        $this->call([
            RolesTableSeeder::class,
            GendersTableSeeder::class,
            CategoriesTableSeeder::class,
            BrandsTableSeeder::class,
            ProductColorsTableSeeder::class,
            ProductSizesTableSeeder::class,
            ProductsTableSeeder::class,
            ProductImagesTableSeeder::class,
            ProductVariantTableSeeder::class,
            CustomersTableSeeder::class,

        ]);
    }
}
