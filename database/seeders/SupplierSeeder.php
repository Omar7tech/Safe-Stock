<?php

namespace Database\Seeders;

use App\Models\Supplier;
use App\Models\User;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;

class SupplierSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Clear existing records to start fresh (optional)
        

        // Fetch all users
        $users = User::all();

        // Initialize Faker generator
        $faker = Faker::create();

        // Define the number of suppliers you want to create
        $numberOfSuppliers = 100;

        // Generate suppliers
        for ($i = 0; $i < $numberOfSuppliers; $i++) {
            // Randomly select a user to associate with the supplier
            $user = $users->random();

            // Create a new supplier record
            Supplier::create([
                'user_id' => $user->id,
                'name' => $faker->company,
                'address' => $faker->address,
                'city' => $faker->city,
                'state' => $faker->state,
                'country' => $faker->country,
                'postal_code' => $faker->postcode,
                'phone' => $faker->phoneNumber,
                'email' => $faker->unique()->safeEmail,
                'contact_person' => $faker->name,
                'website' => $faker->url,
                'tax_id' => $faker->ean8,
                'bank_account' => $faker->iban('DE'),
                'notes' => $faker->text(200),
            ]);
        }
    }
}
