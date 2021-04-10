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
        Permission::create(['name' => 'list-role']);
        Permission::create(['name' => 'create-role']);
        Permission::create(['name' => 'update-role']);
        Permission::create(['name' => 'delete-role']);

        Permission::create(['name' => 'list-user']);
        Permission::create(['name' => 'create-user']);
        Permission::create(['name' => 'update-user']);
        Permission::create(['name' => 'delete-user']);

        Permission::create(['name' => 'list-permission']);
        Permission::create(['name' => 'create-permission']);
        Permission::create(['name' => 'update-permission']);
        Permission::create(['name' => 'delete-permission']);

        Permission::create(['name' => 'manage-settings']);


        $role = Role::create(['name' => User::DEV_ADMIN_ROLE]);
        $role_admin = Role::create(['name' => User::ADMIN_ROLE]);


        $role_admin->givePermissionTo('list-role');
        $role_admin->givePermissionTo('create-role');
        $role_admin->givePermissionTo('update-role');
        $role_admin->givePermissionTo('delete-role');

        $role_admin->givePermissionTo('list-user');
        $role_admin->givePermissionTo('create-user');
        $role_admin->givePermissionTo('update-user');
        $role_admin->givePermissionTo('delete-user');

        $role_admin->givePermissionTo('manage-settings');

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
