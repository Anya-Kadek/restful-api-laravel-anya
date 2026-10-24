<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class ProductSeeder extends Seeder
{
    public function run(): void
    {
        $products = [
            [
                'name' => 'Classic Strawberry Cheesecake',
                'description' => 'Sepotong keju lembut dengan dasar biskuit renyah dan saus stroberi.',
                'category_id' => 1,
                'price' => 35000,
                'img' => 'images/products/Classic Strawberry Cheesecake.png',
                'stock' => 12,
            ],
            [
                'name' => 'Pink Berry Glaze Croissant',
                'description' => 'Croissant mentega berlapis renyah dengan glasir pink dan rasberry.',
                'category_id' => 2,
                'price' => 28000,
                'img' => 'images/products/Pink Berry Glaze Croissant.jpeg',
                'stock' => 15,
            ],
            [
                'name' => 'Raspberry Mousse Cake',
                'description' => 'Kue mousse lembut rasa raspberry dengan topping buah segar.',
                'category_id' => 1,
                'price' => 42000,
                'img' => 'images/products/Raspberry Mousse Cake.jpg',
                'stock' => 10,
            ],
            [
                'name' => 'Creamy Strawberry Croissant',
                'description' => 'Croissant empuk diisi krim vanila kocok dan potongan stroberi.',
                'category_id' => 2,
                'price' => 30000,
                'img' => 'images/products/Creamy Strawberry Croissant.png',
                'stock' => 18,
            ],
            [
                'name' => 'Japanese Strawberry Roll Cake',
                'description' => 'Kue gulung gaya Jepang dengan krim segar dan stroberi utuh.',
                'category_id' => 1,
                'price' => 48000,
                'img' => 'images/products/Japanese Strawberry Roll Cake.jpg',
                'stock' => 8,
            ],
            [
                'name' => 'Pink Fruit Sando',
                'description' => 'Sandwich buah ala Jepang dengan roti pink, stroberi, dan kiwi.',
                'category_id' => 3,
                'price' => 25000,
                'img' => 'images/products/Pink Fruit Sando.jpeg',
                'stock' => 20,
            ],
            [
                'name' => 'Double Layer Raspberry Cake',
                'description' => 'Kue dua tingkat dengan spons lembut, krim putih, dan raspberry.',
                'category_id' => 1,
                'price' => 40000,
                'img' => 'images/products/Double Layer Raspberry Cake.jpg',
                'stock' => 9,
            ],
            [
                'name' => 'Mini Strawberry Dome',
                'description' => 'Kue mini kubah mousse stroberi dengan hiasan krim putar.',
                'category_id' => 1,
                'price' => 32000,
                'img' => 'images/products/Mini Strawberry Dome.jpeg',
                'stock' => 14,
            ],
            [
                'name' => 'Fluffy Raspberry Pancakes',
                'description' => 'Tumpukan pancake lembut dengan saus pink glasir dan almond.',
                'category_id' => 4,
                'price' => 38000,
                'img' => 'images/products/Fluffy Raspberry Pancakes.jpeg',
                'stock' => 15,
            ],
            [
                'name' => 'Berry Pink Smoothie Cup',
                'description' => 'Smoothie buah beri segar dengan topping whipped cream tinggi.',
                'category_id' => 5,
                'price' => 26000,
                'img' => 'images/products/Berry Pink Smoothie Cup.jpg',
                'stock' => 25,
            ],
        ];

        foreach ($products as $product) {
            $slug = Str::slug($product['name']);

            DB::table('products')->updateOrInsert(
                ['slug' => $slug],
                [
                    'name' => $product['name'],
                    'description' => $product['description'],
                    'category_id' => $product['category_id'],
                    'price' => $product['price'],
                    'img' => $product['img'],
                    'stock' => $product['stock'],
                    'updated_at' => now(),
                    'created_at' => now(),
                ]
            );
        }
    }
}