<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Faker\Factory as Faker;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $categories = [
            ['name' => 'Electronics', 'description' => 'Devices and gadgets'],
            ['name' => 'Books', 'description' => 'Printed and digital books'],
            ['name' => 'Furniture', 'description' => 'Home and office furniture'],
            ['name' => 'Clothing', 'description' => 'Men, women, and kids clothing'],
            ['name' => 'Toys', 'description' => 'Toys and games for kids'],
            ['name' => 'Sports', 'description' => 'Sporting goods and equipment'],
            ['name' => 'Beauty', 'description' => 'Beauty and personal care products'],
            ['name' => 'Health', 'description' => 'Health and wellness products'],
            ['name' => 'Automotive', 'description' => 'Car accessories and parts'],
            ['name' => 'Jewelry', 'description' => 'Jewelry and watches'],
            ['name' => 'Groceries', 'description' => 'Food and beverages'],
            ['name' => 'Garden', 'description' => 'Garden and outdoor products'],
            ['name' => 'Tools', 'description' => 'Tools and home improvement'],
            ['name' => 'Pet Supplies', 'description' => 'Products for pets'],
            ['name' => 'Music', 'description' => 'Musical instruments and accessories'],
            ['name' => 'Movies', 'description' => 'DVDs and Blu-rays'],
            ['name' => 'Video Games', 'description' => 'Games and consoles'],
            ['name' => 'Office Supplies', 'description' => 'Office and school supplies'],
            ['name' => 'Art', 'description' => 'Art supplies and decor'],
            ['name' => 'Travel', 'description' => 'Travel accessories and luggage'],
        ];

        // Fetch all users
        $users = User::all();

        // Initialize Faker generator
        $faker = Faker::create();

        foreach ($users as $user) {
            // Randomly select 5 to 10 categories
            $selectedCategories = $faker->randomElements($categories, $faker->numberBetween(5, 10));

            foreach ($selectedCategories as $category) {
                DB::table('categories')->insert([
                    'user_id' => $user->id,
                    'name' => $category['name'],
                    'description' => $category['description'],
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
            }
        }
    }
}
