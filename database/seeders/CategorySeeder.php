<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    public function run(): void
    {
        $cities = [
            [
                'name'        => 'Istanbul',
                'description' => 'A city straddling two continents, blending Ottoman grandeur with modern energy. Home to Hagia Sophia, the Grand Bazaar, and the legendary Bosphorus strait.',
                'image'       => 'https://images.unsplash.com/photo-1524231757912-21f4fe3a7200?w=800&q=80',
            ],
            [
                'name'        => 'Cappadocia',
                'description' => 'A surreal landscape of fairy chimneys, underground cities, and hot air balloons drifting over volcanic valleys at sunrise.',
                'image'       => 'https://images.unsplash.com/photo-1591825729269-caeb344f6df2?w=800&q=80',
            ],
            [
                'name'        => 'Antalya',
                'description' => 'The jewel of the Turkish Riviera — crystal-clear turquoise waters, ancient Roman ruins, and a charming old town surrounded by Taurus Mountains.',
                'image'       => 'https://images.unsplash.com/photo-1571406252241-db0280bd36cd?w=800&q=80',
            ],
            [
                'name'        => 'Pamukkale',
                'description' => 'Famous for its dazzling white calcium terraces and natural thermal pools. Home to the UNESCO-listed ancient city of Hierapolis.',
                'image'       => 'https://images.unsplash.com/photo-1578922746465-3a80a228f223?w=800&q=80',
            ],
        ];

        foreach ($cities as $city) {
            Category::create($city);
        }
    }
}
