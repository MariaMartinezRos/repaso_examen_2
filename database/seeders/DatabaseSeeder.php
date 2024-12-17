<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Comment;
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
        Category::factory(10)->create();
        Product::factory(20)->create();

        //para crear dos comentarios por producto
        $products = Product::all();
        foreach ($products as $product) {
            Comment::factory()->count(2)->create(['product_id' => $product->id]);
        }
    }
}
