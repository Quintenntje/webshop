<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class CustomersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $roleId = DB::table('roles')->where('name', 'customer')->value('id') ?? DB::table('roles')->insertGetId(['name' => 'customer']);

        $customers = [
            [
                'first_name' => 'Alex',
                'last_name' => 'Johnson',
                'email' => 'alex.johnson@example.com',
                'phone_number' => '+32000000001',
                'password' => Hash::make('password'),
                'role_id' => $roleId,
                'created_at' => now(),
            ],
            [
                'first_name' => 'Sam',
                'last_name' => 'Lee',
                'email' => 'sam.lee@example.com',
                'phone_number' => '+32000000002',
                'password' => Hash::make('password'),
                'role_id' => $roleId,
                'created_at' => now(),
            ],
        ];

        DB::table('customers')->insert($customers);
    }
}


