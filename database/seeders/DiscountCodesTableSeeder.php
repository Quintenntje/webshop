<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Carbon;

class DiscountCodesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('discount_codes')->insert([
            [
                'code' => 'WELCOME10',
                'type' => 'percentage',
                'value' => 10.00,
                'expires_at' => Carbon::now()->addMonths(3)->toDateString(),
                'active' => true,
            ],
            [
                'code' => 'FALL5',
                'type' => 'fixed',
                'value' => 5.00,
                'expires_at' => Carbon::now()->addMonths(1)->toDateString(),
                'active' => true,
            ],
            [
                'code' => 'BLACKFRIDAY25',
                'type' => 'percentage',
                'value' => 25.00,
                'expires_at' => Carbon::now()->addMonths(6)->toDateString(),
                'active' => true,
            ],
            [
                'code' => 'EXPIRED15',
                'type' => 'percentage',
                'value' => 15.00,
                'expires_at' => Carbon::now()->subDays(7)->toDateString(),
                'active' => false,
            ],
        ]);
    }
}


