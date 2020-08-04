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
            'role'=>2,
            'created_at'=>new DateTime,
            'updated_at'=>new DateTime
            ],
            [
                'name'=>'Davod',
                'email'=>'davod@devtest.com',
                'password'=>Hash::make('1234'),
                'role'=>2,
                'created_at'=>new DateTime,
                'updated_at'=>new DateTime 
            ],
            [
                'name'=>'reza',
                'email'=>'reza@devtest.com',
                'password'=>Hash::make('1234'),
                'role'=>1,
                'created_at'=>new DateTime,
                'updated_at'=>new DateTime 
            ],
            [
                'name'=>'ahmad',
                'email'=>'ahmad@devtest.com',
                'password'=>Hash::make('1234'),
                'role'=>1,
                'created_at'=>new DateTime,
                'updated_at'=>new DateTime 
            ],
            [
                'name'=>'yasin',
                'email'=>'yasin@devtest.com',
                'password'=>Hash::make('1234'),
                'role'=>1,
                'created_at'=>new DateTime,
                'updated_at'=>new DateTime 
            ],
            [
                'name'=>'neda',
                'email'=>'neda@devtest.com',
                'password'=>Hash::make('1234'),
                'role'=>1,
                'created_at'=>new DateTime,
                'updated_at'=>new DateTime 
            ],
            [
                'name'=>'sogol',
                'email'=>'sogol@devtest.com',
                'password'=>Hash::make('1234'),
                'role'=>1,
                'created_at'=>new DateTime,
                'updated_at'=>new DateTime 
            ],
            [
                'name'=>'sadegh',
                'email'=>'sadegh@devtest.com',
                'password'=>Hash::make('1234'),
                'role'=>1,
                'created_at'=>new DateTime,
                'updated_at'=>new DateTime 
            ],
            [
                'name'=>'afshin',
                'email'=>'afshin@devtest.com',
                'password'=>Hash::make('1234'),
                'role'=>1,
                'created_at'=>new DateTime,
                'updated_at'=>new DateTime 
            ],
            [
                'name'=>'mostafa',
                'email'=>'mostafa@devtest.com',
                'password'=>Hash::make('1234'),
                'role'=>1,
                'created_at'=>new DateTime,
                'updated_at'=>new DateTime 
            ],
            [
                'name'=>'navid',
                'email'=>'navid@devtest.com',
                'password'=>Hash::make('1234'),
                'role'=>1,
                'created_at'=>new DateTime,
                'updated_at'=>new DateTime 
            ],
            [
                'name'=>'behrouz',
                'email'=>'behrouz@devtest.com',
                'password'=>Hash::make('1234'),
                'role'=>1,
                'created_at'=>new DateTime,
                'updated_at'=>new DateTime 
            ],
            
        ]
        ;
        DB::table('users')->insert($user);
    }
}
