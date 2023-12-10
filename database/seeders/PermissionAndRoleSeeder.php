<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class PermissionAndRoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();
        $permissions = [];
        $roles = [
            ['title' => 'Главный администратор', 'name' => 'super-user', 'guard_name' => 'admin'],
        ];

        $role_permissions = [
            'super-user' => [],
        ];

        Permission::upsert($permissions, ['name'], ['title']);

        foreach ($roles as $key => $role) {
            $role_db = Role::firstOrCreate(['name' => $role['name']], $role);
            $perm = Permission::whereIn('name', $role_permissions[$role['name']])->pluck('id');
            $role_db->permissions()->sync($perm);
        }
    }
}
