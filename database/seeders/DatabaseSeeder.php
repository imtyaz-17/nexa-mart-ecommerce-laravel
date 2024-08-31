<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\User;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        // Create a regular user
        User::factory()->create([
            'name' => 'Test User',
            'email' => 'user@gmail.com',
            'phone' => '0123456789',
            'role' => 'user',
            'password' => Hash::make('12341234'),
        ]);

        // Create an admin user
        User::factory()->create([
            'name' => 'Test Admin',
            'email' => 'admin@gmail.com',
            'phone' => '0123456789',
            'role' => 'admin',
            'password' => Hash::make('12341234'),
        ]);
        $seeders = [
            CountrySeeder::class,
            CategorySeeder::class,
            SubCategorySeeder::class,
            BrandSeeder::class,
            ProductSeeder::class,
            ShippingSeeder::class,
            CustomerAddressSeeder::class,
        ];

        $this->call($seeders);
    }
}
