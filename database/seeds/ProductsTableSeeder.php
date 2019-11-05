<?php

use Illuminate\Database\Seeder;
use Faker\Factory as faker;

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
        $products = [];
        $faker = faker::create();
        $cat = ['men','womens','child'];
        $size = ['large','medium','small'];
        for ($i = 0;$i < 200 ;$i++){
            $products[] = [
                'name' => $faker->text(rand(20,40)),
                'description' => $faker->text(rand(500,2400)),
                'units' => rand(0,100),
                'category' => $cat[rand(0,2)],
                'size' => $size[rand(0,2)],
                'price' => rand(20,800) * 1000,
                'image' => 'images/p'. rand(1,4),
                'created_at' => new DateTime,
                'updated_at' => null,
            ];

        }
        DB::table('products')->insert($products);
    }
}
