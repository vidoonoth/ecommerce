<?php

namespace Database\Seeders;

use App\Models\Brand;
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
        // Ensure categories exist or create them
        $shoesCategory = Category::firstOrCreate(['name' => 'Shoes'], ['slug' => Str::slug('Shoes')]);
        $jordanCategory = Category::firstOrCreate(['name' => 'jordan'], ['slug' => Str::slug('jordan')]);
        $lifestyleCategory = Category::firstOrCreate(['name' => 'lifestyle'], ['slug' => Str::slug('lifestyle')]);

        // Ensure brands exist or create them
        $nikeBrand = Brand::firstOrCreate(['name' => 'Nike']);
        $adidasBrand = Brand::firstOrCreate(['name' => 'Adidas']);
        $vansBrand = Brand::firstOrCreate(['name' => 'Vans']);

        $products = [
            [
                'name' => 'Nike Air Jordan 1 2022',
                'description' => 'Comfortable and stylish Nike Air Jordan 1 shoes.',
                'price' => 150.00,
                'stock' => 50,
                'image' => 'products/nike_air_jordan_1_2022.png',
                'category_id' => $jordanCategory->id,
                'brand_id' => $nikeBrand->id,
            ],
            [
                'name' => 'Nike Air VaporMax Plus',
                'description' => 'Lightweight and responsive Nike Air VaporMax Plus.',
                'price' => 130.00,
                'stock' => 45,
                'image' => 'products/nike_air_vapormax_plus.png',
                'category_id' => $lifestyleCategory->id,
                'brand_id' => $nikeBrand->id,
            ],
            [
                'name' => 'Jordan Tatum 4',
                'description' => 'Max cushioning for your daily runs with Jordan Tatum 4.',
                'price' => 180.00,
                'stock' => 40,
                'image' => 'products/jordan_tatum_4.png',
                'category_id' => $shoesCategory->id,
                'brand_id' => $nikeBrand->id,
            ],
            [
                'name' => 'Nike Blazer Low Platform',
                'description' => 'Classic style with a vintage finish, Nike Blazer Low Platform.',
                'price' => 100.00,
                'stock' => 60,
                'image' => 'products/nike_blazer_low_platform.png',
                'category_id' => $shoesCategory->id,
                'brand_id' => $nikeBrand->id,
            ],
            [
                'name' => 'Jordan CMFT Era',
                'description' => 'Ultimate comfort and energy return with Jordan CMFT Era.',
                'price' => 160.00,
                'stock' => 55,
                'image' => 'products/jordan_cmft_era.png',
                'category_id' => $shoesCategory->id,
                'brand_id' => $nikeBrand->id,
            ],
            [
                'name' => 'Air Jordan 1 High G',
                'description' => 'Modern design meets heritage style, Air Jordan 1 High G.',
                'price' => 140.00,
                'stock' => 48,
                'image' => 'products/air_jordan_1_high_g.png',
                'category_id' => $shoesCategory->id,
                'brand_id' => $nikeBrand->id,
            ],
            [
                'name' => 'Tatum 3 PF Sidewalk Chalk',
                'description' => 'Iconic tennis shoe for everyday wear, Tatum 3 PF Sidewalk Chalk.',
                'price' => 80.00,
                'stock' => 70,
                'image' => 'products/tatum_3_pf_sidewalk_chalk.png',
                'category_id' => $shoesCategory->id,
                'brand_id' => $nikeBrand->id,
            ],
            [
                'name' => 'Air Jordan 1 Low SE',
                'description' => 'The legendary shell-toe design, Air Jordan 1 Low SE.',
                'price' => 90.00,
                'stock' => 65,
                'image' => 'products/air_jordan_1_low_se.png',
                'category_id' => $shoesCategory->id,
                'brand_id' => $nikeBrand->id,
            ],
            [
                'name' => 'Jordan Tatum 4 PF',
                'description' => 'Timeless skate shoe with side stripe, Jordan Tatum 4 PF.',
                'price' => 70.00,
                'stock' => 80,
                'image' => 'products/tatum_4_pf.png',
                'category_id' => $shoesCategory->id,
                'brand_id' => $nikeBrand->id,
            ],
            [
                'name' => 'Air Jordan 1 Mid',
                'description' => 'High-top classic for skateboarding and style, Air Jordan 1 Mid.',
                'price' => 75.00,
                'stock' => 75,
                'image' => 'products/air_jordan_1_mid.png',
                'category_id' => $shoesCategory->id,
                'brand_id' => $nikeBrand->id,
            ],
            [
                'name' => 'Jumpman MVP',
                'description' => 'The original deck shoe, Jumpman MVP.',
                'price' => 60.00,
                'stock' => 90,
                'image' => 'products/jumpman_mvp.png',
                'category_id' => $shoesCategory->id,
                'brand_id' => $nikeBrand->id,
            ],
            [
                'name' => 'Adidas Yeezy 350 V2 Bred',
                'description' => 'Responsive cushioning for a comfortable run, Adidas Yeezy 350 V2 Bred.',
                'price' => 170.00,
                'stock' => 50,
                'image' => 'products/adidas_yeezy_350_v2_bred.png',
                'category_id' => $shoesCategory->id,
                'brand_id' => $adidasBrand->id,
            ],
            [
                'name' => 'Vans Knu Skool',
                'description' => 'Reissued 90s style with a puffy tongue and ankle collar, Vans Knu Skool.',
                'price' => 80.00,
                'stock' => 55,
                'image' => 'products/vans_knu_skool.png',
                'category_id' => $shoesCategory->id,
                'brand_id' => $vansBrand->id,
            ],
        ];

        foreach ($products as $productData) {
            Product::create([
                'category_id' => $productData['category_id'],
                'brand_id' => $productData['brand_id'],
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
