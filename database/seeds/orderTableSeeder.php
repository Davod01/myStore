<?php

use Illuminate\Database\Seeder;

class orderTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('orders')->truncate();
        $orders = [];
        for ($i = 0;$i < 800 ;$i++){
            $orders[] = [
                'product_id' => rand(1,200),
                'user_id' => rand(3,12),
                'quantity' => 1,
                'address' => 'zahedan karimpor 7',
                'is_delivered' => rand(0,1),
                'created_at' => $this->randomDate('2020-01-01 00:00:00','2020-05-04 00:00:00'),
                'updated_at' => null,
            ];

        }
        DB::table('orders')->insert($orders);
    }
    public function randomDate($strStartDate,$strEndDate,$sFormat = 'Y-m-d h:m:s'){
        $fMin = strtotime($strStartDate);
        $fMax = strtotime($strEndDate);
        // Generate a random number from the start and end dates
        $fVal = mt_rand($fMin, $fMax);
        // Convert back to the specified date format
        return date($sFormat, $fVal);
    }
}
