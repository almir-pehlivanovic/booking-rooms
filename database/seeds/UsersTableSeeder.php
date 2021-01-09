<?php

use Illuminate\Database\Seeder;
use Carbon\Carbon;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            [
                'name'      => 'Almir Pehlivanovic',
                'slug'      => 'almir-pehlivanovic',
                'email'     => 'pehlivanovicalmir1@gmail.com',
                'password'  => bcrypt('admintestpassword'),
                'created_at'=> Carbon::now(),
            ],
            [
                'name'      => 'Test TestUser',
                'slug'      => 'test-user',
                'email'     => 'test@test.com',
                'password'  => bcrypt('testuserpassword'),
                'created_at'=> Carbon::now(),
            ],
        ]);    
    }
}
