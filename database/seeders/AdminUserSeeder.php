<?php

namespace Database\Seeders;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AdminUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('users')->insert([
            'name' => 'Admin',
            'role' => 'admin',
            'active' => true,
            'email' => 'admins@gmail.com',
            'mobile' => '713879463',
            'password' => Hash::make('admin1234'),
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }
}
