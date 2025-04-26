<?php

namespace Database\Seeders;

use App\Models\Seller;
use App\Models\Category;
use App\Models\Product;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        User::factory(10)->create();

        Seller::factory(10)->sequence(
            fn ($sequence) => ['user_id' => $sequence->index + 1]
        )->create();

        // User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);

        $categories = ['casing', 'cpu', 'gpu', 'motherboard', 'peripherals', 'powersupply', 'ram', 'storage'];

        $j = 1;
        foreach ($categories as $category) {
            Category::create([
                'name' => $category,
            ]);

            for ($i = 1; $i <= 5; $i++ ) {
                Product::factory()->create([
                    'seller_id' => rand(1,10),
                    'category_id' => $j,
                    'product_image' => $category . '/' . $category . $i . '.png'
                ]);
            }

            $j++;
        }

        // Product::factory()->create([

        // ]);
    }
}
