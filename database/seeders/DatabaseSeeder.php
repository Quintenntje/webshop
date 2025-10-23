<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {


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
            DiscountCodesTableSeeder::class,

        ]);

                // optional demo user
                if (!DB::table('users')->where('email', 'test@example.com')->exists()) {
                    User::factory()->create([
                        'name' => 'Test User',
                        'email' => 'test@example.com',
                        'password' => Hash::make('password'),
                        'role_id' => 1,
                        'created_at' => now(),
                        'updated_at' => now(),
                    ]);
                }
        
                // admin account for Filament
                if (!DB::table('users')->where('email', 'admin@admin.com')->exists()) {
                    User::factory()->create([
                        'name' => 'Admin',
                        'email' => 'admin@admin.com',
                        'password' => Hash::make('admin'),
                        'role_id' => 2,
                        'created_at' => now(),
                        'updated_at' => now(),
                    ]);
                }
    }
}
