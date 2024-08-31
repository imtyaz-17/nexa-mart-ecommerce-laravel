<?php

namespace Database\Seeders;

use App\Models\Country;
use App\Models\CustomerAddress;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CustomerAddressSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $user = User::first();
        CustomerAddress::create([
            'user_id' => $user->id,
            'first_name' => 'John',
            'last_name' => 'Doe',
            'email' => 'john.doe@example.com',
            'mobile' => '1234567890',
            'country_id' => 226,
            'address' => '123 Main St',
            'apartment' => 'Apt 4B',
            'city' => 'New York',
            'state' => 'NY',
            'zip' => '10001',
            'order_notes' => 'Please leave the package at the front door.',
        ]);
    }
}
