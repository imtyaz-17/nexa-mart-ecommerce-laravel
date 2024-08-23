<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('categories')->insert([
            [
                'id' => 1,
                'name' => 'Electronics',
                'slug' => 'electronics',
                'image' => '1724322040_66c710f8d7be4.jpg',
                'status' => 1,
                'created_at' => '2024-08-22 17:20:42',
                'updated_at' => '2024-08-22 17:20:42',
            ],
            [
                'id' => 2,
                'name' => 'Fashion',
                'slug' => 'fashion',
                'image' => '1724319011_66c70523bd758.jpg',
                'status' => 1,
                'created_at' => '2024-08-22 16:30:14',
                'updated_at' => '2024-08-22 16:30:14',
            ],
            [
                'id' => 3,
                'name' => 'Home & Kitchen',
                'slug' => 'home-kitchen',
                'image' => '1724319046_66c7054667193.jpg',
                'status' => 1,
                'created_at' => '2024-08-22 16:30:50',
                'updated_at' => '2024-08-22 16:30:50',
            ],
            [
                'id' => 4,
                'name' => 'Beauty & Personal Care',
                'slug' => 'beauty-personal-care',
                'image' => '1724319156_66c705b43fa62.jfif',
                'status' => 1,
                'created_at' => '2024-08-22 16:32:38',
                'updated_at' => '2024-08-22 16:32:38',
            ],
            [
                'id' => 5,
                'name' => 'Sports & Outdoors',
                'slug' => 'sports-outdoors',
                'image' => '1724319277_66c7062d72daa.jpg',
                'status' => 1,
                'created_at' => '2024-08-22 16:34:39',
                'updated_at' => '2024-08-22 16:34:39',
            ],
            [
                'id' => 6,
                'name' => 'Automotive',
                'slug' => 'automotive',
                'image' => '1724319302_66c7064686fe5.jpg',
                'status' => 1,
                'created_at' => '2024-08-22 16:35:04',
                'updated_at' => '2024-08-22 16:35:04',
            ],
        ]);
    }
}
