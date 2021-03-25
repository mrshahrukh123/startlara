<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Spatie\Permission\PermissionRegistrar;

class UserRolePermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        app()[PermissionRegistrar::class]->forgetCachedPermissions();

        /**
         * Basic permissions which in start seeding we will give to admin role users
         */
        Permission::create(['name' => 'role-list']);
        Permission::create(['name' => 'role-create']);
        Permission::create(['name' => 'role-update']);
        Permission::create(['name' => 'role-delete']);

        Permission::create(['name' => 'user-list']);
        Permission::create(['name' => 'user-create']);
        Permission::create(['name' => 'user-update']);
        Permission::create(['name' => 'user-delete']);


        $role = Role::create(['name' => User::DEV_ADMIN_ROLE]);
        $role_admin = Role::create(['name' => User::ADMIN_ROLE]);

        $role_admin->givePermissionTo('role-list');
        $role_admin->givePermissionTo('role-create');
        $role_admin->givePermissionTo('role-update');
        $role_admin->givePermissionTo('role-delete');

        $role_admin->givePermissionTo('user-list');
        $role_admin->givePermissionTo('user-create');
        $role_admin->givePermissionTo('user-update');
        $role_admin->givePermissionTo('user-delete');

        $user = \App\Models\User::factory()->create([
            'name' => 'Dev Admin',
            'email' => 'devadmin@startlara.local',
        ]);
        $user->assignRole($role);

        $user = \App\Models\User::factory()->create([
            'name' => 'Admin',
            'email' => 'admin@startlara.local',
        ]);
        $user->assignRole($role_admin);
    }
}
