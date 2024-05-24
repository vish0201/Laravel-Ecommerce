<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Faker\Factory as Faker;

class ProductsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create();

        // Create 10 fake products
        for ($i = 0; $i < 50; $i++) {
            DB::table('products')->insert([
                'name' => $faker->word,
                'description' => $faker->sentence,
                'images' => json_encode(["Placeholder-image.webp", "Placeholder-image.webp"]), 
                'price' => $faker->numberBetween(0, 1000),
                'cat_id' => $faker->randomElement([1, 2 , 3]),
                'featured' => $faker->boolean,
            ]);
        }
    }
}
