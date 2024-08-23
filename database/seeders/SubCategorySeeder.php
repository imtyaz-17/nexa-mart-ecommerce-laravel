<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SubCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('sub_categories')->insert([
            [
                'id' => 1,
                'name' => 'Mobile Phones',
                'slug' => 'mobile-phones',
                'status' => 1,
                'category_id' => 1,
                'created_at' => '2024-08-22 17:50:11',
                'updated_at' => '2024-08-22 17:50:11',
            ],
            [
                'id' => 2,
                'name' => 'Laptops & Computers',
                'slug' => 'laptops-computers',
                'status' => 1,
                'category_id' => 1,
                'created_at' => '2024-08-22 17:50:31',
                'updated_at' => '2024-08-22 17:50:31',
            ],
            [
                'id' => 3,
                'name' => 'Cameras & Photography',
                'slug' => 'cameras-photography',
                'status' => 1,
                'category_id' => 1,
                'created_at' => '2024-08-22 17:50:49',
                'updated_at' => '2024-08-22 17:50:49',
            ],
            [
                'id' => 4,
                'name' => "Men's Clothing",
                'slug' => 'mens-clothing',
                'status' => 1,
                'category_id' => 2,
                'created_at' => '2024-08-22 17:51:11',
                'updated_at' => '2024-08-22 17:51:11',
            ],
            [
                'id' => 5,
                'name' => "Women's Clothing",
                'slug' => 'womens-clothing',
                'status' => 1,
                'category_id' => 2,
                'created_at' => '2024-08-22 17:51:31',
                'updated_at' => '2024-08-22 17:51:31',
            ],
            [
                'id' => 6,
                'name' => 'Jewelry',
                'slug' => 'jewelry',
                'status' => 1,
                'category_id' => 2,
                'created_at' => '2024-08-22 17:52:06',
                'updated_at' => '2024-08-22 17:52:06',
            ],
            [
                'id' => 7,
                'name' => 'Furniture',
                'slug' => 'furniture',
                'status' => 1,
                'category_id' => 3,
                'created_at' => '2024-08-22 17:52:32',
                'updated_at' => '2024-08-22 17:52:32',
            ],
            [
                'id' => 8,
                'name' => 'Kitchen Appliances',
                'slug' => 'kitchen-appliances',
                'status' => 1,
                'category_id' => 3,
                'created_at' => '2024-08-22 17:52:53',
                'updated_at' => '2024-08-22 17:52:53',
            ],
            [
                'id' => 9,
                'name' => 'Home Decor',
                'slug' => 'home-decor',
                'status' => 1,
                'category_id' => 3,
                'created_at' => '2024-08-22 17:53:23',
                'updated_at' => '2024-08-22 17:53:23',
            ],
            [
                'id' => 10,
                'name' => 'Skincare',
                'slug' => 'skincare',
                'status' => 1,
                'category_id' => 4,
                'created_at' => '2024-08-22 17:53:44',
                'updated_at' => '2024-08-22 17:53:44',
            ],
            [
                'id' => 11,
                'name' => 'Hair Care',
                'slug' => 'hair-care',
                'status' => 1,
                'category_id' => 4,
                'created_at' => '2024-08-22 17:53:57',
                'updated_at' => '2024-08-22 17:53:57',
            ],
            [
                'id' => 12,
                'name' => 'Makeup & Cosmetics',
                'slug' => 'makeup-cosmetics',
                'status' => 1,
                'category_id' => 4,
                'created_at' => '2024-08-22 17:54:12',
                'updated_at' => '2024-08-22 17:54:12',
            ],
            [
                'id' => 13,
                'name' => 'Exercise Equipment',
                'slug' => 'exercise-equipment',
                'status' => 1,
                'category_id' => 5,
                'created_at' => '2024-08-22 17:54:40',
                'updated_at' => '2024-08-22 17:54:40',
            ],
            [
                'id' => 14,
                'name' => 'Sportswear',
                'slug' => 'sportswear',
                'status' => 1,
                'category_id' => 5,
                'created_at' => '2024-08-22 17:55:08',
                'updated_at' => '2024-08-22 17:55:08',
            ],
            [
                'id' => 15,
                'name' => 'Car Accessories',
                'slug' => 'car-accessories',
                'status' => 1,
                'category_id' => 6,
                'created_at' => '2024-08-22 17:55:33',
                'updated_at' => '2024-08-22 17:55:33',
            ],
            [
                'id' => 16,
                'name' => 'Motorcycle Gear',
                'slug' => 'motorcycle-gear',
                'status' => 1,
                'category_id' => 6,
                'created_at' => '2024-08-22 17:55:57',
                'updated_at' => '2024-08-22 17:55:57',
            ],
        ]);
    }
}
