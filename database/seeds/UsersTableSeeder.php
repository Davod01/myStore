<?php

use Illuminate\Database\Seeder;

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
        $user = [
            'name'=>'Admin',
            'email'=>'admin@devtest.com',
            'password'=>bcrypt('secret'),
            'is_admin'=>true,
            'created_at'=>new DateTime,
            'updated_at'=>new DateTime
        ];
        DB::table('users')->insert($user);
    }
}
