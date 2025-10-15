<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categories = Category::all();

        if ($categories->isEmpty()) {
            $this->call(CategorySeeder::class);
            $categories = Category::all();
        }

        $products = [
            [
                'name' => 'Smartphone X',
                'description' => 'A powerful smartphone with advanced features.',
                'price' => 799.99,
                'stock' => 50,
                'image' => 'products/smartphone_x.jpg',
                'category' => 'Electronics',
            ],
            [
                'name' => 'Laptop Pro',
                'description' => 'High-performance laptop for professionals.',
                'price' => 1200.00,
                'stock' => 30,
                'image' => 'products/laptop_pro.jpg',
                'category' => 'Electronics',
            ],
            [
                'name' => 'Designer T-Shirt',
                'description' => 'Stylish and comfortable t-shirt.',
                'price' => 25.00,
                'stock' => 100,
                'image' => 'products/tshirt.jpg',
                'category' => 'Fashion',
            ],
            [
                'name' => 'Cookware Set',
                'description' => 'Complete set of non-stick cookware.',
                'price' => 150.50,
                'stock' => 20,
                'image' => 'products/cookware.jpg',
                'category' => 'Home & Kitchen',
            ],
            [
                'name' => 'Fantasy Novel',
                'description' => 'An epic fantasy adventure.',
                'price' => 15.99,
                'stock' => 75,
                'image' => 'products/fantasy_novel.jpg',
                'category' => 'Books',
            ],
        ];

        foreach ($products as $productData) {
            $category = $categories->where('name', $productData['category'])->first();

            if ($category) {
                Product::create([
                    'category_id' => $category->id,
                    'name' => $productData['name'],
                    'slug' => Str::slug($productData['name']),
                    'description' => $productData['description'],
                    'price' => $productData['price'],
                    'stock' => $productData['stock'],
                    'image' => $productData['image'],
                ]);
            }
        }
    }
}
