<?php

use Illuminate\Database\Seeder;

class ProductsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('products')->truncate();
        $products = [
            [
                    'name' => "MEN'S BETTER THAN NAKED & JACKET",
                    'description' => 'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
                    tempor incididunt ut labore et dolore magna aliqua consequat.',
                    'units' => 21,
                    'price' => 200.10,
                    'image' => 'p1',
                    'created_at' => new DateTime,
                    'updated_at' => null,
                ],
                [
                    'name' => "WOMEN'S BETTER THAN NAKED™ JACKET",
                    'description' => 'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
                    tempor incididunt ut labore et dolore magna aliqua consequat.',
                    'units' => 400,
                    'price' => 1600.21,
                    'image' => 'p2',
                    'created_at' => new DateTime,
                    'updated_at' => null,
                ],
                [
                    'name' => "WOMEN'S SINGLE-TRACK SHOE",
                    'description' => 'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
                    tempor incididunt ut labore et dolore magna aliqua consequat.',
                    'units' => 37,
                    'price' => 378.00,
                    'image' => 'p3',
                    'created_at' => new DateTime,
                    'updated_at' => null,
                ],
                [
                    'name' => 'Enduro Boa® Hydration Pack',
                    'description' => 'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
                    tempor incididunt ut labore et dolore magna aliqua consequat.',
                    'units' => 10,
                    'price' => 21.10,
                    'image' => 'p4',
                    'created_at' => new DateTime,
                    'updated_at' => null,
                ]
        ];
        DB::table('products')->insert($products);
    }
}
