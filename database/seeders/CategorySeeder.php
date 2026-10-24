<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CategorySeeder extends Seeder
{
    public function run(): void
    {
        $categories = [
            ['category_id' => 1, 'category' => 'Cake & Pastry'],
            ['category_id' => 2, 'category' => 'Croissant'],
            ['category_id' => 3, 'category' => 'Sandwich'],
            ['category_id' => 4, 'category' => 'Pancakes'],
            ['category_id' => 5, 'category' => 'Minuman'],
        ];

        foreach ($categories as $category) {
            DB::table('categories')->updateOrInsert(
                ['category_id' => $category['category_id']],
                [
                    'category' => $category['category'],
                    'updated_at' => now(),
                    'created_at' => now(),
                ]
            );
        }
    }
}