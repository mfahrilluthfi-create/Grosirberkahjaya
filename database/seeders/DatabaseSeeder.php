<?php

// File: database/seeders/DatabaseSeeder.php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // Create Admin User
        User::create([
            'name' => 'Admin Grosir Berkah Jaya',
            'email' => 'admin@Grosirberkahjaya.com',
            'password' => Hash::make('password'),
            'role' => 'admin',
            'phone' => '081234567890',
        ]);

        // Create Customer User
        User::create([
            'name' => 'Customer Test',
            'email' => 'customer@test.com',
            'password' => Hash::make('password'),
            'role' => 'customer',
            'phone' => '081298765432',
            'address' => 'Jl. Test No. 123',
            'city' => 'Jakarta',
            'province' => 'DKI Jakarta',
            'postal_code' => '12345',
        ]);

        // Create Categories
        $categories = [
            ['name' => 'Laptop & PC', 'slug' => 'laptop', 'icon' => 'fa-laptop'],
            ['name' => 'Smartphone', 'slug' => 'smartphone', 'icon' => 'fa-mobile-alt'],
            ['name' => 'Audio & Video', 'slug' => 'audio', 'icon' => 'fa-headphones'],
            ['name' => 'Aksesoris', 'slug' => 'accessories', 'icon' => 'fa-plug'],
        ];

        foreach ($categories as $cat) {
            Category::create($cat);
        }

        // Create Products
        $products = [
            [
                'category_id' => 1,
                'name' => 'Laptop Gaming ROG Strix',
                'slug' => 'laptop-gaming-rog-strix',
                'description' => 'Laptop gaming powerful untuk gaming dan content creation dengan performa maksimal.',
                'price' => 15000000,
                'discount' => 10,
                'stock' => 5,
                'specifications' => [
                    'Intel Core i7-11800H',
                    '16GB RAM DDR4',
                    'NVIDIA RTX 3060 6GB',
                    '512GB NVMe SSD',
                    'Display 15.6" FHD 144Hz',
                ],
                'is_active' => true,
            ],

        ];

        foreach ($products as $product) {
            Product::create($product);
        }
    }
}
