<?php

use Illuminate\Database\Seeder;
use Carbon\Carbon;
use App\Permission;
use App\Role;

class PermissionTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $permissions = new Permission();

        $permissions  = [
            [
                'name' => 'permission-index',
                'created_at' => Carbon::now(),
            ],
            [
                'name' => 'permission-create',
                'created_at' => Carbon::now(),
            ],
            [
                'name' => 'permission-store',
                'created_at' => Carbon::now(),
            ],
            [
                'name' => 'permission-show',
                'created_at' => Carbon::now(),
            ],
            [
                'name' => 'permission-edit',
                'created_at' => Carbon::now(),
            ],
            [
                'name' => 'permission-update',
                'created_at' => Carbon::now(),
            ],
            [
                'name' => 'permission-destroy',
                'created_at' => Carbon::now(),
            ],
            [
                'name' => 'role-index',
                'created_at' => Carbon::now(),
            ],
            [
                'name' => 'role-create',
                'created_at' => Carbon::now(),
            ],
            [
                'name' => 'role-store',
                'created_at' => Carbon::now(),
            ],
            [
                'name' => 'role-show',
                'created_at' => Carbon::now(),
            ],
            [
                'name' => 'role-edit',
                'created_at' => Carbon::now(),
            ],
            [
                'name' => 'role-update',
                'created_at' => Carbon::now(),
            ],
            [
                'name' => 'role-destroy',
                'created_at' => Carbon::now(),
            ],
            [
                'name' => 'user-index',
                'created_at' => Carbon::now(),
            ],
            [
                'name' => 'user-create',
                'created_at' => Carbon::now(),
            ],
            [
                'name' => 'user-store',
                'created_at' => Carbon::now(),
            ],
            [
                'name' => 'user-show',
                'created_at' => Carbon::now(),
            ],
            [
                'name' => 'user-edit',
                'created_at' => Carbon::now(),
            ],
            [
                'name' => 'user-update',
                'created_at' => Carbon::now(),
            ],
            [
                'name' => 'user-destroy',
                'created_at' => Carbon::now(),
            ],
            [
                'name' => 'user-restore',
                'created_at' => Carbon::now(),
            ],
            [
                'name' => 'user-forceDestroy',
                'created_at' => Carbon::now(),
            ],
            [
                'name' => 'room-index',
                'created_at' => Carbon::now(),
            ],
            [
                'name' => 'room-create',
                'created_at' => Carbon::now(),
            ],
            [
                'name' => 'room-store',
                'created_at' => Carbon::now(),
            ],
            [
                'name' => 'room-show',
                'created_at' => Carbon::now(),
            ],
            [
                'name' => 'room-edit',
                'created_at' => Carbon::now(),
            ],
            [
                'name' => 'room-update',
                'created_at' => Carbon::now(),
            ],
            [
                'name' => 'room-destroy',
                'created_at' => Carbon::now(),
            ],
            [
                'name' => 'room-restore',
                'created_at' => Carbon::now(),
            ],
            [
                'name' => 'room-forceDestroy',
                'created_at' => Carbon::now(),
            ],
            [
                'name' => 'event-index',
                'created_at' => Carbon::now(),
            ],
            [
                'name' => 'event-create',
                'created_at' => Carbon::now(),
            ],
            [
                'name' => 'event-store',
                'created_at' => Carbon::now(),
            ],
            [
                'name' => 'event-show',
                'created_at' => Carbon::now(),
            ],
            [
                'name' => 'event-edit',
                'created_at' => Carbon::now(),
            ],
            [
                'name' => 'event-update',
                'created_at' => Carbon::now(),
            ],
            [
                'name' => 'event-destroy',
                'created_at' => Carbon::now(),
            ],
            [
                'name' => 'event-restore',
                'created_at' => Carbon::now(),
            ],
            [
                'name' => 'event-forceDestroy',
                'created_at' => Carbon::now(),
            ],
            [
                'name' => 'calendar-index',
                'created_at' => Carbon::now(),
            ],
            [
                'name' => 'home-index',
                'created_at' => Carbon::now(),
            ],
            [
                'name' => 'booking-searchRoom',
                'created_at' => Carbon::now(),
            ],
            [
                'name' => 'booking-bookRoom',
                'created_at' => Carbon::now(),
            ],
            [
                'name' => 'balance-index',
                'created_at' => Carbon::now(),
            ],
            [
                'name' => 'balance-add',
                'created_at' => Carbon::now(),
            ],
            [
                'name' => 'transaction-index',
                'created_at' => Carbon::now(),
            ],
            [
                'name' => 'transaction-show',
                'created_at' => Carbon::now(),
            ],
            [
                'name' => 'home-edit',
                'created_at' => Carbon::now(),
            ],
            [
                'name' => 'home-update',
                'created_at' => Carbon::now(),
            ],
            [
                'name' => 'user-reminder',
                'created_at' => Carbon::now(),
            ],
            [
                'name' => 'balance-show',
                'created_at' => Carbon::now(),
            ],
            [
                'name' => 'transaction-destroy',
                'created_at' => Carbon::now(),
            ],
        ];

        Permission::insert($permissions);

        $permissions     = Permission::pluck('id');
        $permissionsUser = Permission::whereIn('id',[36, 42, 43, 44, 45, 46, 47, 50, 51, 53])->pluck('id');

        //attach permission to the roles
        $admin  = Role::whereName('admin')->first();
        $user   = Role::whereName('user')->first();
        
        $admin->attachPermissions($permissions);
        $user->attachPermissions($permissionsUser);
    }
}
