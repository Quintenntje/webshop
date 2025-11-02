<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProductsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $brandIds = DB::table('brands')->pluck('id');
        $categoryIds = DB::table('categories')->pluck('id');
        $genderIds = DB::table('genders')->pluck('id');

        $products = [
            ['name' => 'Air Runner', 'price' => 99.99, 'description' => 'Lightweight running shoes with responsive cushioning and breathable mesh upper. Perfect for daily training and long-distance runs. Features advanced air technology for maximum comfort and energy return.'],
            ['name' => 'City Sneaker Low', 'price' => 84.99, 'description' => 'Versatile low-top sneakers designed for urban exploration. Clean minimalist design with premium materials and superior comfort. Ideal for walking, casual wear, and light activities around the city.'],
            ['name' => 'Trail Blazer GTX', 'price' => 129.95, 'description' => 'Waterproof hiking boots with Gore-Tex technology for ultimate protection. Aggressive tread pattern provides excellent traction on rocky terrain. Durable construction built to withstand the toughest outdoor adventures.'],
            ['name' => 'Court Classic', 'price' => 74.50, 'description' => 'Timeless tennis shoes with classic court styling. Leather upper with rubber outsole for superior grip on hard courts. Comfortable fit and traditional design that never goes out of style.'],
            ['name' => 'Street Glide', 'price' => 89.90, 'description' => 'Sleek skateboarding shoes with reinforced toe cap and grippy sole. Designed for street skating with excellent board feel and durability. Modern styling meets functional performance.'],
            ['name' => 'Ultra Boost Runner', 'price' => 159.00, 'description' => 'Premium running shoes with revolutionary Boost midsole technology. Provides maximum energy return and cushioning for serious runners. Primeknit upper offers adaptive fit and breathability.'],
            ['name' => 'Everyday Slip-On', 'price' => 49.00, 'description' => 'Convenient slip-on shoes perfect for busy lifestyles. Easy on/off design with comfortable memory foam insole. Versatile style that works for casual outings and quick errands.'],
            ['name' => 'Canvas Hi-Top', 'price' => 59.00, 'description' => 'Classic high-top canvas sneakers with retro styling. Durable canvas upper with rubber toe cap and vulcanized sole. Timeless design that pairs with any casual outfit.'],
            ['name' => 'Retro Jogger 90s', 'price' => 94.50, 'description' => 'Nostalgic 90s-inspired running shoes with bold colors and chunky silhouette. Retro styling meets modern comfort technology. Perfect for those who love vintage athletic aesthetics.'],
            ['name' => 'Minimal Leather Sneaker', 'price' => 119.00, 'description' => 'Premium leather sneakers with clean, minimalist design. Handcrafted from high-quality leather with attention to detail. Sophisticated style suitable for both casual and smart-casual occasions.'],
            ['name' => 'Skate Pro Vulc', 'price' => 69.99, 'description' => 'Professional skateboarding shoes with vulcanized construction. Enhanced durability and board feel for serious skaters. Reinforced areas where skaters need it most.'],
            ['name' => 'Marathon Racer', 'price' => 139.99, 'description' => 'Lightweight racing shoes designed for competitive runners. Minimal weight with maximum performance features. Responsive cushioning and breathable upper for speed and comfort.'],
            ['name' => 'Kids Lightning Sneaker', 'price' => 39.99, 'description' => 'Fun and colorful sneakers designed specifically for active kids. Easy-to-use velcro closure and durable construction. Bright colors and comfortable fit that kids will love.'],
            ['name' => 'All-Weather Trek', 'price' => 109.99, 'description' => 'Versatile outdoor shoes built for all weather conditions. Water-resistant upper with breathable membrane. Rugged outsole provides traction on wet and dry surfaces alike.'],
            ['name' => 'Plush Cloud Runner', 'price' => 129.00, 'description' => 'Ultra-comfortable running shoes with cloud-like cushioning. Maximum shock absorption for joint protection. Perfect for runners seeking plush comfort without sacrificing performance.'],
            ['name' => 'Tempo Training Shoe', 'price' => 89.00, 'description' => 'Multi-purpose training shoes for gym workouts and cross-training. Stable platform with responsive cushioning. Versatile design handles everything from weightlifting to cardio.'],
            ['name' => 'Court Luxe Women', 'price' => 99.00, 'description' => 'Elegant tennis shoes designed specifically for women. Sleek silhouette with premium materials and feminine styling. Superior court performance with fashion-forward design.'],
            ['name' => 'Prime Knit Slip', 'price' => 89.50, 'description' => 'Innovative slip-on shoes with seamless Primeknit construction. Adaptive fit that conforms to your foot shape. Modern technology meets effortless style and comfort.'],
            ['name' => 'Stability Road Pro', 'price' => 149.00, 'description' => 'Advanced stability running shoes for overpronators. Engineered to correct foot motion and prevent injuries. Premium materials and cutting-edge stability technology.'],
            ['name' => 'Classic Suede', 'price' => 79.00, 'description' => 'Timeless suede sneakers with vintage-inspired design. Soft suede upper with comfortable rubber sole. Classic styling that complements any casual wardrobe.'],
        ];

        foreach ($products as $product) {
            DB::table('products')->insert([
                'name' => $product['name'],
                'price' => $product['price'],
                'description' => json_encode($product['description']),
                'gender_id' => $genderIds->random(),
                'brand_id' => $brandIds->random(),
                'category_id' => $categoryIds->random(),
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}


