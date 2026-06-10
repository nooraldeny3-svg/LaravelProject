<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    public function run(): void
    {
        $categories = [
            [
                'name'        => 'Smartphones',
                'description' => 'Latest flagship and mid-range smartphones from top brands. Stay connected with cutting-edge mobile technology.',
                'image'       => 'https://images.unsplash.com/photo-1511707171634-5f897ff02aa9?w=800&q=80',
            ],
            [
                'name'        => 'Laptops & PCs',
                'description' => 'Powerful laptops and desktops for work, gaming, and creative professionals.',
                'image'       => 'https://images.unsplash.com/photo-1496181133206-80ce9b88a853?w=800&q=80',
            ],
            [
                'name'        => 'Audio & Sound',
                'description' => 'Premium headphones, earbuds, and speakers for the ultimate listening experience.',
                'image'       => 'https://images.unsplash.com/photo-1505740420928-5e560c06d30e?w=800&q=80',
            ],
            [
                'name'        => 'Gaming',
                'description' => 'Consoles, games, controllers, and gaming accessories for every type of gamer.',
                'image'       => 'https://images.unsplash.com/photo-1612287230202-1ff1d85d1bdf?w=800&q=80',
            ],
            [
                'name'        => 'Smart Devices',
                'description' => 'Smartwatches, tablets, smart home devices, and wearable technology.',
                'image'       => 'https://images.unsplash.com/photo-1523275335684-37898b6baf30?w=800&q=80',
            ],
        ];

        foreach ($categories as $category) {
            Category::create($category);
        }
    }
}
