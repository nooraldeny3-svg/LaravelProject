<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    public function run(): void
    {
        $istanbul   = Category::where('name', 'Istanbul')->first()->id;
        $cappadocia = Category::where('name', 'Cappadocia')->first()->id;
        $antalya    = Category::where('name', 'Antalya')->first()->id;
        $pamukkale  = Category::where('name', 'Pamukkale')->first()->id;

        $tours = [
            [
                'category_id'   => $istanbul,
                'title'         => 'Bosphorus Sunset Cruise',
                'description'   => 'Sail along the legendary Bosphorus strait as the sun sets over Istanbul. Enjoy stunning views of historic palaces, mosques, and the unique two-continent skyline. Dinner and live Turkish music included.',
                'price'         => 89.00,
                'duration_days' => 1,
                'image'         => 'https://images.unsplash.com/photo-1541432901042-2d8bd64b4a9b?w=800&q=80',
                'is_available'  => true,
            ],
            [
                'category_id'   => $istanbul,
                'title'         => 'Old City & Grand Bazaar Walking Tour',
                'description'   => 'Explore Istanbul\'s 2,500-year-old history on foot. Visit the Hagia Sophia, Blue Mosque, Topkapi Palace, and the legendary Grand Bazaar with over 4,000 shops. English-speaking guide included.',
                'price'         => 65.00,
                'duration_days' => 1,
                'image'         => 'https://images.unsplash.com/photo-1558618666-fcd25c85cd64?w=800&q=80',
                'is_available'  => true,
            ],
            [
                'category_id'   => $cappadocia,
                'title'         => 'Hot Air Balloon Ride at Sunrise',
                'description'   => 'Float above Cappadocia\'s magical fairy chimneys and valleys in a hot air balloon as the sun rises. This once-in-a-lifetime experience includes a champagne toast upon landing.',
                'price'         => 180.00,
                'duration_days' => 1,
                'image'         => 'https://images.unsplash.com/photo-1543158181-e6f9f6712055?w=800&q=80',
                'is_available'  => true,
            ],
            [
                'category_id'   => $cappadocia,
                'title'         => 'Underground Cities & Valleys Hike',
                'description'   => 'Discover the ancient underground cities carved into volcanic rock thousands of years ago. Then hike through the Rose Valley and Pigeon Valley, taking in extraordinary rock formations.',
                'price'         => 75.00,
                'duration_days' => 2,
                'image'         => 'https://images.unsplash.com/photo-1506905925346-21bda4d32df4?w=800&q=80',
                'is_available'  => true,
            ],
            [
                'category_id'   => $cappadocia,
                'title'         => 'Cappadocia Full Experience (3 Days)',
                'description'   => 'The ultimate Cappadocia package: hot air balloon ride, underground city tour, horse riding through the valleys, cave restaurant dinner, and a night in a traditional cave hotel.',
                'price'         => 420.00,
                'duration_days' => 3,
                'image'         => 'https://images.unsplash.com/photo-1568605117036-5fe5e7bab0b7?w=800&q=80',
                'is_available'  => true,
            ],
            [
                'category_id'   => $antalya,
                'title'         => 'Antalya Old Town & Waterfalls Day Trip',
                'description'   => 'Explore the charming Roman harbour and cobblestone streets of Kaleiçi (Old Antalya), then head to the magnificent Düden Waterfalls cascading directly into the Mediterranean Sea.',
                'price'         => 55.00,
                'duration_days' => 1,
                'image'         => 'https://images.unsplash.com/photo-1571406252241-db0280bd36cd?w=800&q=80',
                'is_available'  => true,
            ],
            [
                'category_id'   => $antalya,
                'title'         => 'Turkish Riviera Beach & Boat Tour',
                'description'   => 'Spend a perfect day on the crystal-clear turquoise waters of the Turkish Riviera. Swim in hidden coves, snorkel among colourful fish, and enjoy a fresh fish lunch on board.',
                'price'         => 70.00,
                'duration_days' => 1,
                'image'         => 'https://images.unsplash.com/photo-1540541338287-41700207dee6?w=800&q=80',
                'is_available'  => true,
            ],
            [
                'category_id'   => $pamukkale,
                'title'         => 'Pamukkale Thermal Pools & Hierapolis',
                'description'   => 'Walk barefoot across the dazzling white calcium terraces of Pamukkale and soak in the natural warm mineral pools. Explore the UNESCO-listed ruins of Hierapolis, including the ancient theatre.',
                'price'         => 95.00,
                'duration_days' => 2,
                'image'         => 'https://images.unsplash.com/photo-1578922746465-3a80a228f223?w=800&q=80',
                'is_available'  => true,
            ],
        ];

        foreach ($tours as $tour) {
            Product::create($tour);
        }
    }
}
