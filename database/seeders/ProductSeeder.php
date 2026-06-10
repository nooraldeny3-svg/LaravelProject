<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    public function run(): void
    {
        $phones  = Category::where('name', 'Smartphones')->first()->id;
        $laptops = Category::where('name', 'Laptops & PCs')->first()->id;
        $audio   = Category::where('name', 'Audio & Sound')->first()->id;
        $gaming  = Category::where('name', 'Gaming')->first()->id;
        $smart   = Category::where('name', 'Smart Devices')->first()->id;

        $products = [
            [
                'category_id'  => $phones,
                'brand'        => 'Apple',
                'title'        => 'iPhone 15 Pro Max',
                'description'  => 'The most powerful iPhone ever. Featuring the A17 Pro chip, a titanium design, and the most advanced iPhone camera system with 48MP main camera, Action button, and USB-C connectivity. Available in natural, blue, white, and black titanium.',
                'price'        => 1199.00,
                'stock'        => 45,
                'image'        => 'https://images.unsplash.com/photo-1632661674596-df8be070a5c5?w=800&q=80',
                'is_available' => true,
            ],
            [
                'category_id'  => $phones,
                'brand'        => 'Samsung',
                'title'        => 'Samsung Galaxy S24 Ultra',
                'description'  => 'The ultimate Galaxy experience. Snapdragon 8 Gen 3, 200MP camera, built-in S Pen, and a stunning 6.8" Dynamic AMOLED display. 100x Space Zoom and AI-powered photo editing features push mobile photography to new heights.',
                'price'        => 1299.00,
                'stock'        => 38,
                'image'        => 'https://images.unsplash.com/photo-1610945265064-0e34e5519bbf?w=800&q=80',
                'is_available' => true,
            ],
            [
                'category_id'  => $phones,
                'brand'        => 'Google',
                'title'        => 'Google Pixel 8 Pro',
                'description'  => 'Google\'s most advanced phone. Custom Tensor G3 chip with on-device AI, a 50MP triple camera with Magic Eraser, Temperature Sensor, and 7 years of guaranteed OS and security updates. The purest Android experience.',
                'price'        => 999.00,
                'stock'        => 52,
                'image'        => 'https://images.unsplash.com/photo-1598327105666-5b89351aff97?w=800&q=80',
                'is_available' => true,
            ],
            [
                'category_id'  => $phones,
                'brand'        => 'OnePlus',
                'title'        => 'OnePlus 12',
                'description'  => 'Performance flagship at a breakthrough price. Snapdragon 8 Gen 3, Hasselblad-tuned 50MP triple camera, 100W SUPERVOOC fast charging, and a 6.82" ProXDR Display. The perfect balance of speed, style, and value.',
                'price'        => 799.00,
                'stock'        => 30,
                'image'        => 'https://images.unsplash.com/photo-1585060544812-6b45742d762f?w=800&q=80',
                'is_available' => true,
            ],
            [
                'category_id'  => $laptops,
                'brand'        => 'Apple',
                'title'        => 'MacBook Pro 14" M3 Pro',
                'description'  => 'Supercharged by M3 Pro, MacBook Pro takes its extraordinary performance to new heights. Featuring a stunning 14.2" Liquid Retina XDR display, up to 22 hours of battery life, and a full suite of pro ports including HDMI, SD card, and MagSafe 3.',
                'price'        => 1999.00,
                'stock'        => 20,
                'image'        => 'https://images.unsplash.com/photo-1517336714731-489689fd1ca8?w=800&q=80',
                'is_available' => true,
            ],
            [
                'category_id'  => $laptops,
                'brand'        => 'Dell',
                'title'        => 'Dell XPS 15 (2024)',
                'description'  => 'The XPS 15 redefines the premium Windows laptop. Intel Core i9-14900H, NVIDIA RTX 4070, a breathtaking 15.6" OLED touchscreen, and an ultra-thin CNC aluminum chassis. Engineered for creators who demand the very best.',
                'price'        => 1899.00,
                'stock'        => 15,
                'image'        => 'https://images.unsplash.com/photo-1593642632559-0c6d3fc62b89?w=800&q=80',
                'is_available' => true,
            ],
            [
                'category_id'  => $laptops,
                'brand'        => 'Lenovo',
                'title'        => 'ThinkPad X1 Carbon Gen 12',
                'description'  => 'The world\'s lightest 14" business laptop at just 2.48 lbs. Intel Core Ultra 7 processor, up to 32GB RAM, MIL-SPEC durability tested, and Lenovo\'s legendary keyboard. Built for professionals who work anywhere.',
                'price'        => 1599.00,
                'stock'        => 25,
                'image'        => 'https://images.unsplash.com/photo-1611078489935-0cb964de46d6?w=800&q=80',
                'is_available' => true,
            ],
            [
                'category_id'  => $laptops,
                'brand'        => 'ASUS',
                'title'        => 'ROG Zephyrus G14 (2024)',
                'description'  => 'The most powerful compact gaming laptop. AMD Ryzen 9 8945HS, NVIDIA RTX 4070, a 14" QHD+ 165Hz OLED display, and an iconic AniMe Matrix LED lid. Weighing just 3.64 lbs — raw power without compromise.',
                'price'        => 1799.00,
                'stock'        => 18,
                'image'        => 'https://images.unsplash.com/photo-1593642634524-b40b5baae6bb?w=800&q=80',
                'is_available' => true,
            ],
            [
                'category_id'  => $audio,
                'brand'        => 'Apple',
                'title'        => 'AirPods Pro (2nd Gen)',
                'description'  => 'The world\'s best noise-cancelling earbuds. H2 chip, Adaptive Transparency, Personalized Spatial Audio, and up to 30 hours of listening with MagSafe charging case. USB-C connectivity for modern devices.',
                'price'        => 249.00,
                'stock'        => 80,
                'image'        => 'https://images.unsplash.com/photo-1572635196237-14b3f281503f?w=800&q=80',
                'is_available' => true,
            ],
            [
                'category_id'  => $audio,
                'brand'        => 'Sony',
                'title'        => 'Sony WH-1000XM5',
                'description'  => 'Industry-leading noise cancelling with two processors and 8 microphones. 30-hour battery life, crystal-clear hands-free calling, and multi-device pairing. The definitive over-ear headphones for work and travel.',
                'price'        => 349.00,
                'stock'        => 55,
                'image'        => 'https://images.unsplash.com/photo-1505740420928-5e560c06d30e?w=800&q=80',
                'is_available' => true,
            ],
            [
                'category_id'  => $audio,
                'brand'        => 'Bose',
                'title'        => 'Bose QuietComfort Ultra',
                'description'  => 'Bose\'s best noise cancelling headphones ever. Immersive Audio, CustomTune technology, and 24 hours of battery life. Adjustable noise cancellation lets you tune in or tune out — on your terms.',
                'price'        => 429.00,
                'stock'        => 40,
                'image'        => 'https://images.unsplash.com/photo-1487215078519-e21cc028cb29?w=800&q=80',
                'is_available' => true,
            ],
            [
                'category_id'  => $gaming,
                'brand'        => 'Sony',
                'title'        => 'PlayStation 5 Console',
                'description'  => 'Experience lightning-fast loading with an ultra-high speed SSD, deeper immersion with haptic feedback, adaptive triggers, and 3D Audio. Play an incredible generation of PlayStation games in stunning 4K.',
                'price'        => 499.00,
                'stock'        => 12,
                'image'        => 'https://images.unsplash.com/photo-1607853202273-797f1c22a38e?w=800&q=80',
                'is_available' => true,
            ],
            [
                'category_id'  => $gaming,
                'brand'        => 'Microsoft',
                'title'        => 'Xbox Series X',
                'description'  => 'The most powerful Xbox ever. True 4K gaming, high frame rates, ray tracing, and a custom SSD that virtually eliminates load times. Play thousands of games across four generations with full backward compatibility.',
                'price'        => 499.00,
                'stock'        => 10,
                'image'        => 'https://images.unsplash.com/photo-1587744518851-c2e1b2afcfde?w=800&q=80',
                'is_available' => true,
            ],
            [
                'category_id'  => $gaming,
                'brand'        => 'Nintendo',
                'title'        => 'Nintendo Switch OLED Model',
                'description'  => 'Play at home or on the go with a vibrant 7-inch OLED screen. Wide adjustable stand, dock with wired LAN port, 64GB of internal storage, and enhanced audio. The ultimate hybrid gaming console.',
                'price'        => 349.00,
                'stock'        => 35,
                'image'        => 'https://images.unsplash.com/photo-1578303512597-81e6cc155b3e?w=800&q=80',
                'is_available' => true,
            ],
            [
                'category_id'  => $smart,
                'brand'        => 'Apple',
                'title'        => 'Apple Watch Series 9',
                'description'  => 'The most advanced Apple Watch yet. S9 chip powers the new Double Tap gesture, a 2000-nit display, onboard Siri, and more precise location. Track fitness, health, and stay connected all from your wrist.',
                'price'        => 399.00,
                'stock'        => 60,
                'image'        => 'https://images.unsplash.com/photo-1523275335684-37898b6baf30?w=800&q=80',
                'is_available' => true,
            ],
            [
                'category_id'  => $smart,
                'brand'        => 'Samsung',
                'title'        => 'Samsung Galaxy Tab S9 Ultra',
                'description'  => 'The ultimate tablet experience. A 14.6" Dynamic AMOLED 2X display, Snapdragon 8 Gen 2, S Pen included, and IP68 water resistance. Whether creating content, gaming, or multitasking — this is the Android tablet for professionals.',
                'price'        => 1099.00,
                'stock'        => 22,
                'image'        => 'https://images.unsplash.com/photo-1585771724684-38269d6639fd?w=800&q=80',
                'is_available' => true,
            ],
        ];

        foreach ($products as $product) {
            Product::create($product);
        }
    }
}
