<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class WishlistTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $customerIds = DB::table('customers')->pluck('id');
        $productIds = DB::table('products')->pluck('id');

        if ($customerIds->isEmpty() || $productIds->isEmpty()) {
            return;
        }

        $rows = [];
        foreach ($customerIds as $customerId) {
            $sampleProducts = $productIds->random(min(3, $productIds->count()));
            foreach ($sampleProducts as $productId) {
                $rows[] = [
                    'customer_id' => $customerId,
                    'product_id' => $productId,
                    'created_at' => now(),
                    'updated_at' => now(),
                ];
            }
        }

        DB::table('wishlist')->insert($rows);
    }
}


