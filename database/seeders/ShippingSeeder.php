<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ShippingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('shipping_charges')->insert([
            [
                'id' => 1,
                'country_id' => 226,
                'amount' => 50,
                'created_at' => '2024-08-22 23:59:07',
                'updated_at' => '2024-08-23 12:16:48',
            ],
            [
                'id' => 2,
                'country_id' => 18,
                'amount' => 10,
                'created_at' => '2024-08-22 23:59:20',
                'updated_at' => '2024-08-23 12:17:02',
            ],
            [
                'id' => 3,
                'country_id' => 13,
                'amount' => 30,
                'created_at' => '2024-08-22 23:59:36',
                'updated_at' => '2024-08-23 12:17:14',
            ],
            [
                'id' => 5,
                'country_id' => 99991,
                'amount' => 100,
                'created_at' => '2024-08-23 01:35:22',
                'updated_at' => '2024-08-23 01:35:22',
            ],
        ]);
    }
}
