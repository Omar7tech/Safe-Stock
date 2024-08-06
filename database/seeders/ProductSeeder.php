<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use App\Models\Category;
use App\Models\Supplier;

class ProductSeeder extends Seeder
{
    public function run()
    {
        // Fetch some categories and suppliers from the database
        $categories = Category::pluck('id')->toArray();
        $suppliers = Supplier::pluck('id')->toArray();
        $users = User::pluck('id')->toArray();

        // Ensure there are some categories and suppliers
        if (empty($categories) || empty($suppliers)) {
            $this->command->info('No categories or suppliers found in the database.');
            return;
        }

        // Generate some dummy products
        $products = [];
        for ($i = 1; $i <= 2000; $i++) {
            $products[] = [
                'user_id' => $users[array_rand($users)], // You might need to adjust this according to your setup
                'category_id' => $categories[array_rand($categories)],
                'supplier_id' => $suppliers[array_rand($suppliers)],
                'name' => 'Product ' . $i,
                'description' => 'Description for Product ' . $i,
                'price' => rand(100, 1000) / 10,
                'stock_quantity' => rand(10, 100),
                'sku' => 'SKU' . Str::random(8),
                'is_active' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ];
        }

        // Insert products into the database
        DB::table('products')->insert($products);

    }
}
