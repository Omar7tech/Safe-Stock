<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        for ($i = 0; $i < 10; $i++) {
            DB::table('users')->insert([
                'name' => fake()->name,
                'email' => fake()->unique()->safeEmail(),
                'mobile' => fake()->unique()->phoneNumber(),
                'password' => Hash::make('user1234'),
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }

        DB::table('users')->insert([
            'name' => "ahmad",
            'email' => "ahmad@gmail.com",
            'mobile' => fake()->unique()->phoneNumber(),
            'password' => Hash::make('ahmad1234'),
            'created_at' => now(),
            'updated_at' => now(),
        ]);

    }
}
