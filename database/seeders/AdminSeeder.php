<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::factory()->create([
            'profile_image' => null,
            'lname' => 'Admin',
            'fname' => 'Administrator',
            'address' => fake()->address,
            'phone' => fake()->phoneNumber,
            'gender' => 'Male',
            'email' => 'admin@mail.com',
            'password' => bcrypt('password')
        ])->assignRole('Admin', 'User')
            ->givePermissionTo('manage-all', 'customer',);

        User::factory()->create([
            'profile_image' => null,
            'lname' => 'Dumanat',
            'fname' => 'Mary Rose',
            'address' => fake()->address,
            'phone' => fake()->phoneNumber,
            'gender' => 'Female',
            'email' => 'maryrosedumanat@gmail.com',
            'password' => bcrypt('password')
        ])->assignRole('User')
            ->givePermissionTo('customer');
    }
}
