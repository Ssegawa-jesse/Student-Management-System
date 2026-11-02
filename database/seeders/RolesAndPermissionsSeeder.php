<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Spatie\Permission\PermissionRegistrar;

class RolesAndPermissionsSeeder extends Seeder
{
    public const ROLE_PERMISSIONS = [
        'admin' => [
            'manage students',
            'manage courses',
            'manage registrations',
            'manage users',
            'view course students',
        ],
        'lecturer' => [
            'view assigned courses',
            'view course students',
        ],
        'student' => [
            'view available courses',
            'register courses',
            'view own registrations',
        ],
    ];

    public function run(): void
    {
        app()[PermissionRegistrar::class]->forgetCachedPermissions();

        $all = collect(self::ROLE_PERMISSIONS)->flatten()->unique();

        foreach ($all as $permission) {
            Permission::firstOrCreate(['name' => $permission, 'guard_name' => 'web']);
        }

        foreach (self::ROLE_PERMISSIONS as $roleName => $permissions) {
            $role = Role::firstOrCreate(['name' => $roleName, 'guard_name' => 'web']);
            $role->syncPermissions($permissions);
        }

        app()[PermissionRegistrar::class]->forgetCachedPermissions();
    }
}