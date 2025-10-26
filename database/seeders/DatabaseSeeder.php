<?php

namespace Database\Seeders;

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

        // User CS
        User::factory()->create([
            'name' => 'CS User',
            'email' => 'cs@example.com',
            'password' => bcrypt('password'),
            'is_cs' => true,
        ]);

        // User Customer
        User::factory()->create([
            'name' => 'Customer User',
            'email' => 'customer@example.com',
            'password' => bcrypt('password'),
            'is_cs' => false,
        ]);
        // alfn
        User::factory()->create([
            'name' => 'Alfin',
            'email' => 'alfinvidoo@gmail.com',
            'password' => bcrypt('password'),
            'is_cs' => false,
        ]);

        User::factory()->create([
            'name' => 'a',
            'email' => 'a@example.com',
            'password' => bcrypt('password'),
            'is_cs' => false,
        ]);

        $this->call([
            AdminSeeder::class,
            CategorySeeder::class,
            BrandSeeder::class,
            ProductSeeder::class,
        ]);
    }
}
