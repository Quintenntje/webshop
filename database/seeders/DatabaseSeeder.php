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
            ProductDiscountsTableSeeder::class,
            CustomersTableSeeder::class,
            DiscountCodesTableSeeder::class,

        ]);

        // Resolve role IDs by name (no hardcoded IDs)
        $adminRoleId = DB::table('roles')->where('name', 'admin')->value('id');
        if (!$adminRoleId) {
            $adminRoleId = DB::table('roles')->insertGetId(['name' => 'admin']);
        }

        // admin account for Filament
        if (!DB::table('users')->where('email', 'admin@admin.com')->exists()) {
            User::factory()->create([
                'name' => 'Admin',
                'email' => 'admin@admin.com',
                'password' => Hash::make('admin'),
                'role_id' => $adminRoleId,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
