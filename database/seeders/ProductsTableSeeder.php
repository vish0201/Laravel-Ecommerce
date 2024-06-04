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

        // Array of image filenames
        $imageFilenames = ["Placeholder-image.webp", "placeholder-images3.webp", "placeholder-images4.webp", "Placeholder-image2.webp", "placeholder-images6_large.webp"];

        // Counter for featured products
        $featuredCount = 0;

        // Create 10 fake products
        for ($i = 0; $i < 50; $i++) {
            // Randomly select image filenames
            $randomImages = [];
            for ($j = 0; $j < 3; $j++) { // Assuming you want 3 images per product
                $randomImages[] = $imageFilenames[array_rand($imageFilenames)];
            }

            // Determine if the product is featured
            $isFeatured = $faker->boolean && $featuredCount < 6;

            // Increment the featured count if the product is featured
            if ($isFeatured) {
                $featuredCount++;
            }

            DB::table('products')->insert([
                'name' => $faker->word,
                'description' => $faker->sentence,
                'images' => json_encode($randomImages),
                'price' => $faker->numberBetween(0, 1000),
                'cat_id' => $faker->randomElement([1, 2, 3]),
                'featured' => $isFeatured,
            ]);
        }
    }
}
