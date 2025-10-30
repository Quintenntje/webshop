<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class ProductDiscountsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Get some product IDs to add discounts to
        $productIds = DB::table('products')->pluck('id')->take(8)->toArray(); // Get first 8 products for discounts

        if (empty($productIds)) {
            return; // No products to add discounts to
        }

        $discounts = [
            // Percentage discounts
            ['product_id' => $productIds[0] ?? null, 'type' => 'percentage', 'value' => 20, 'start_date' => null, 'expire_date' => Carbon::now()->addDays(30), 'active' => true],
            ['product_id' => $productIds[1] ?? null, 'type' => 'percentage', 'value' => 15, 'start_date' => null, 'expire_date' => Carbon::now()->addDays(45), 'active' => true],
            ['product_id' => $productIds[2] ?? null, 'type' => 'percentage', 'value' => 25, 'start_date' => null, 'expire_date' => Carbon::now()->addDays(20), 'active' => true],
            ['product_id' => $productIds[3] ?? null, 'type' => 'percentage', 'value' => 30, 'start_date' => null, 'expire_date' => Carbon::now()->addDays(60), 'active' => true],

            // Fixed amount discounts
            ['product_id' => $productIds[4] ?? null, 'type' => 'fixed', 'value' => 20.00, 'start_date' => null, 'expire_date' => Carbon::now()->addDays(25), 'active' => true],
            ['product_id' => $productIds[5] ?? null, 'type' => 'fixed', 'value' => 15.00, 'start_date' => null, 'expire_date' => Carbon::now()->addDays(40), 'active' => true],
            ['product_id' => $productIds[6] ?? null, 'type' => 'percentage', 'value' => 35, 'start_date' => null, 'expire_date' => Carbon::now()->addDays(15), 'active' => true],
            ['product_id' => $productIds[7] ?? null, 'type' => 'fixed', 'value' => 25.00, 'start_date' => null, 'expire_date' => Carbon::now()->addDays(50), 'active' => true],
        ];

        foreach ($discounts as $discount) {
            if ($discount['product_id']) {
                DB::table('product_discounts')->insert([
                    'product_id' => $discount['product_id'],
                    'type' => $discount['type'],
                    'value' => $discount['value'],
                    'start_date' => $discount['start_date'],
                    'expire_date' => $discount['expire_date'],
                    'active' => $discount['active'],
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
            }
        }
    }
}

