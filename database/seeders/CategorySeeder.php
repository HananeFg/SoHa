<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        Category::create([
            'title' => 'Category 1',
            'slug' => 'category-1',
            'image' => 'category1.jpg',
        ]);

        Category::create([
            'title' => 'Category 2',
            'slug' => 'category-2',
            'image' => 'category2.jpg',
        ]);
    }
}
