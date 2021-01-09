<?php

use Illuminate\Database\Seeder;
use App\Role;
use App\User;

class RolesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        // Create Admin role
        $admin = new Role();
        $admin->name = "admin";
        $admin->display_name = "Admin";
        $admin->save();

        // Create Admin role
        $user = new Role();
        $user->name = "user";
        $user->display_name = "User";
        $user->save();

        //attach role to user
        $user1 = User::find(1);
        $user1->detachRole($admin);
        $user1->attachRole($admin);

        //attach role to user
        $user2 = User::find(2);
        $user2->detachRole($user);
        $user2->attachRole($user);
    }


}
