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

        // Ensure 'Shoes' category exists or create it
        $shoesCategory = $categories->where('name', 'Shoes')->first();
        if (!$shoesCategory) {
            $shoesCategory = Category::create([
                'name' => 'Shoes',
                'slug' => Str::slug('Shoes'),
            ]);
            $categories->push($shoesCategory); // Add to collection for immediate use
        }

        // Ensure 'Nike' category exists or create it
        $nikeCategory = $categories->where('name', 'Nike')->first();
        if (!$nikeCategory) {
            $nikeCategory = Category::create([
                'name' => 'Nike',
                'slug' => Str::slug('Nike'),
            ]);
            $categories->push($nikeCategory);
        }

        // Ensure 'Adidas' category exists or create it
        $adidasCategory = $categories->where('name', 'Adidas')->first();
        if (!$adidasCategory) {
            $adidasCategory = Category::create([
                'name' => 'Adidas',
                'slug' => Str::slug('Adidas'),
            ]);
            $categories->push($adidasCategory);
        }

        // Ensure 'Vans' category exists or create it
        $vansCategory = $categories->where('name', 'Vans')->first();
        if (!$vansCategory) {
            $vansCategory = Category::create([
                'name' => 'Vans',
                'slug' => Str::slug('Vans'),
            ]);
            $categories->push($vansCategory);
        }


        $products = [
            [
                'name' => 'Nike Air Jordan 1 2022',
                'description' => 'Comfortable and stylish Nike Air Jordan 1 shoes.',
                'price' => 150.00,
                'stock' => 50,
                'image' => 'products/nike_air_jordan_1_2022.png',
                'category' => 'Nike',
            ],
            [
                'name' => 'Nike Air VaporMax Plus',
                'description' => 'Lightweight and responsive Nike Air VaporMax Plus.',
                'price' => 130.00,
                'stock' => 45,
                'image' => 'products/nike_air_vapormax_plus.png',
                'category' => 'Nike',
            ],
            [
                'name' => 'Jordan Tatum 4',
                'description' => 'Max cushioning for your daily runs with Jordan Tatum 4.',
                'price' => 180.00,
                'stock' => 40,
                'image' => 'products/jordan_tatum_4.png',
                'category' => 'Nike',
            ],
            [
                'name' => 'Nike Blazer Low Platform',
                'description' => 'Classic style with a vintage finish, Nike Blazer Low Platform.',
                'price' => 100.00,
                'stock' => 60,
                'image' => 'products/nike_blazer_low_platform.png',
                'category' => 'Nike',
            ],
            [
                'name' => 'Jordan CMFT Era',
                'description' => 'Ultimate comfort and energy return with Jordan CMFT Era.',
                'price' => 160.00,
                'stock' => 55,
                'image' => 'products/jordan_cmft_era.png',
                'category' => 'Nike',
            ],
            [
                'name' => 'Air Jordan 1 High G',
                'description' => 'Modern design meets heritage style, Air Jordan 1 High G.',
                'price' => 140.00,
                'stock' => 48,
                'image' => 'products/air_jordan_1_high_g.png',
                'category' => 'Nike',
            ],
            [
                'name' => 'Tatum 3 PF Sidewalk Chalk',
                'description' => 'Iconic tennis shoe for everyday wear, Tatum 3 PF Sidewalk Chalk.',
                'price' => 80.00,
                'stock' => 70,
                'image' => 'products/tatum_3_pf_sidewalk_chalk.png',
                'category' => 'Nike',
            ],
            [
                'name' => 'Air Jordan 1 Low SE',
                'description' => 'The legendary shell-toe design, Air Jordan 1 Low SE.',
                'price' => 90.00,
                'stock' => 65,
                'image' => 'products/air_jordan_1_low_se.png',
                'category' => 'Nike',
            ],
            [
                'name' => 'Jordan Tatum 4 PF',
                'description' => 'Timeless skate shoe with side stripe, Jordan Tatum 4 PF.',
                'price' => 70.00,
                'stock' => 80,
                'image' => 'products/tatum_4_pf.png',
                'category' => 'Nike',
            ],
            [
                'name' => 'Air Jordan 1 Mid',
                'description' => 'High-top classic for skateboarding and style, Air Jordan 1 Mid.',
                'price' => 75.00,
                'stock' => 75,
                'image' => 'products/air_jordan_1_mid.png',
                'category' => 'Nike',
            ],
            [
                'name' => 'Jumpman MVP',
                'description' => 'The original deck shoe, Jumpman MVP.',
                'price' => 60.00,
                'stock' => 90,
                'image' => 'products/jumpman_mvp.png',
                'category' => 'Nike',
            ],
            [
                'name' => 'Adidas Yeezy 350 V2 Bred',
                'description' => 'Responsive cushioning for a comfortable run, Adidas Yeezy 350 V2 Bred.',
                'price' => 170.00,
                'stock' => 50,
                'image' => 'products/adidas_yeezy_350_v2_bred.png',
                'category' => 'Adidas',
            ],
            [
                'name' => 'Vans Knu Skool',
                'description' => 'Reissued 90s style with a puffy tongue and ankle collar, Vans Knu Skool.',
                'price' => 80.00,
                'stock' => 55,
                'image' => 'products/vans_knu_skool.png',
                'category' => 'Vans',
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
