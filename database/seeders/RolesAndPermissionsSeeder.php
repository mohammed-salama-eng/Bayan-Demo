<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RolesAndPermissionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();

        $permissions = [
            'view posts',
            'create posts',
            'edit posts',
            'delete posts',
        ];

        foreach ($permissions as $permission) {
            Permission::firstOrCreate(['name' => $permission]);
        }

        $admin = Role::firstOrCreate(['name' => 'admin']);
        $admin->syncPermissions($permissions);

        $editor = Role::firstOrCreate(['name' => 'editor']);
        $editor->syncPermissions(['view posts', 'create posts', 'edit posts', 'delete posts']);

        $userRole = Role::firstOrCreate(['name' => 'user']);
        $userRole->syncPermissions(['view posts', 'create posts']);
    }
}
