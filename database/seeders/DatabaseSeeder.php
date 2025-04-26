<?php

namespace Database\Seeders;

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

        // User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);

        $categories = ['casing', 'cpu', 'gpu', 'motherboard', 'peripherals', 'powersupply', 'ram', 'storage'];

        foreach ($categories as $category) {
            Category::create([
                'category_name' => $category,
            ]);

            for ($i = 1; $i <= 5; $i++ ) {
                Product::create([
                    'seller_id' => rand(1,10),
                ])
            }
        }

        

        Product::factory()->create([

        ]);
    }
}
