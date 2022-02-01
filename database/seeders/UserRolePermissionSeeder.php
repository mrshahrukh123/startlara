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

        $secure_permission_arr = array(
            'list-permission',
            'create-permission',
            'update-permission',
            'delete-permission',
        );

        $permissions_arr = array(
            'list-role',
            'create-role',
            'update-role',
            'delete-role',
            'list-user',
            'create-user',
            'update-user',
            'delete-user',
            'manage-settings',
        );

        $dev_admin_permissions = array_merge($permissions_arr, $secure_permission_arr);

        $admin_permission_arr = array_merge($permissions_arr);

        foreach ($dev_admin_permissions as $permission_name) {
            Permission::create(['name' => $permission_name]);
        }

        $role = Role::create(['name' => User::DEV_ADMIN_ROLE]);
        $role_admin = Role::create(['name' => User::ADMIN_ROLE]);

        foreach ($admin_permission_arr as $permission_name) {
            if ($permission_name) {
                $role_admin->givePermissionTo($permission_name);
            }
        }

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
