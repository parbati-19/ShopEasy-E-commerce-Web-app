<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Product;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    // database/seeders/DatabaseSeeder.php
    public function run()
    {
        // Create categories
        $electronics = Category::create(['name' => 'Electronics', 'slug' => 'electronics']);
        $fashion = Category::create(['name' => 'Fashion', 'slug' => 'fashion']);

        // Create products
        Product::create([
            'name' => 'Laptop Pro 15"',
            'slug' => 'laptop-pro-15',
            'description' => 'High-performance laptop',
            'price' => 1299.99,
            'compare_price' => 1499.99,
            'stock' => 10,
            'sku' => 'LAP001',
            'category_id' => $electronics->id,
            'is_featured' => true,
            'is_flash' => true,
        ]);
    }
}