<?php

namespace Database\Seeders;

use App\Models\Seller;
use App\Models\Category;
use App\Models\Product;
use App\Models\User;
use App\Models\ProductRating;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Create 10 users
        User::factory(10)->create();

        // Create 10 sellers associated with users
        Seller::factory(10)->sequence(
            fn ($sequence) => ['user_id' => $sequence->index + 1]
        )->create();

        $categories = ['Casing', 'CPU', 'GPU', 'Motherboard', 'Peripherals', 'Powersupply', 'RAM', 'Storage'];

        $j = 1;
        foreach ($categories as $category) {
            Category::create([
                'name' => $category,
            ]);

            // Create 5 products per category
            for ($i = 1; $i <= 5; $i++) {
                Product::factory()->create([
                    'seller_id' => rand(1,10),
                    'category_id' => $j,
                    'image' => 'https://storage.googleapis.com/project_toko_danish/image/' . strtolower($category) . '/' . strtolower($category) . $i . '.jpg'
                ]);
            }

            $j++;
        }

        // Seed product ratings
        $this->seedProductRatings();
    }

    protected function seedProductRatings(): void
    {
        $products = Product::all();
        $users = User::all();

        // Create 3-5 random ratings for each product
        foreach ($products as $product) {
            $ratingCount = rand(3, 5);

            for ($i = 0; $i < $ratingCount; $i++) {
                ProductRating::create([
                    'product_id' => $product->id,
                    'user_id' => $users->random()->id,
                    'rating' => rand(3, 5), // Random rating between 3-5 (more realistic than 1-5)
                    'rating_description' => $this->generateRandomReview(),
                    'created_at' => now()->subDays(rand(0, 30)) // Random date in last 30 days
                ]);
            }
        }
    }

    protected function generateRandomReview(): string
    {
        $reviews = [
            'Great product, works perfectly!',
            'Very satisfied with my purchase',
            'Good quality for the price',
            'Fast shipping and good packaging',
            'Exactly as described',
            'Would definitely buy again',
            'Excellent performance',
            'Met my expectations',
            'Good customer service too',
            'No complaints, works great'
        ];

        return $reviews[array_rand($reviews)];
    }
}
