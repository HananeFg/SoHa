<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class MenuSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        Menu::create([
            'title' => 'Menu 1',
            'slug' => 'menu-1',
            'unit_price' => 10.99,
            'TTC_price' => 13.19,
            'TVA' => 2.2,
            'image' => 'menu1.jpg',
            'category_id' => 1,
        ]);

        Menu::create([
            'title' => 'Menu 2',
            'slug' => 'menu-2',
            'unit_price' => 8.99,
            'TTC_price' => 10.79,
            'TVA' => 1.8,
            'image' => 'menu2.jpg',
            'category_id' => 2,
        ]);
    }
}
