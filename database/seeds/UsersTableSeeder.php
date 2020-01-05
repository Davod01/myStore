<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->truncate();
        $user = [[
            'name'=>'Admin',
            'email'=>'admin@devtest.com',
            'password'=>Hash::make('1234'),
            'is_admin'=>true,
            'created_at'=>new DateTime,
            'updated_at'=>new DateTime
            ],
            [
                'name'=>'Davod',
                'email'=>'davod@devtest.com',
                'password'=>Hash::make('1234'),
                'is_admin'=>false,
                'created_at'=>new DateTime,
                'updated_at'=>new DateTime 
            ]
            
        ]
        ;
        DB::table('users')->insert($user);
    }
}
