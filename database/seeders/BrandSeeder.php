<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class BrandSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('brands')->insert([
            [
                'id' => 1,
                'name' => 'Apple',
                'slug' => 'apple',
                'image' => '1724324265_66c719a99abfc.jpg',
                'status' => 1,
                'created_at' => '2024-08-22 17:57:48',
                'updated_at' => '2024-08-22 17:57:48',
            ],
            [
                'id' => 2,
                'name' => 'Canon',
                'slug' => 'canon',
                'image' => '1724324307_66c719d37edde.png',
                'status' => 1,
                'created_at' => '2024-08-22 17:58:43',
                'updated_at' => '2024-08-22 17:58:43',
            ],
            [
                'id' => 3,
                'name' => 'Adidas',
                'slug' => 'adidas',
                'image' => '1724324352_66c71a00d1416.png',
                'status' => 1,
                'created_at' => '2024-08-22 17:59:15',
                'updated_at' => '2024-08-22 17:59:15',
            ],
            [
                'id' => 4,
                'name' => 'Gucci',
                'slug' => 'gucci',
                'image' => '1724324425_66c71a49ee848.png',
                'status' => 1,
                'created_at' => '2024-08-22 18:00:28',
                'updated_at' => '2024-08-22 18:00:28',
            ],
        ]);
    }
}
