<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        $permissions = [
            'view_dashboard',
            'view_roles',
            'view_posts',
            'create_posts',
            'edit_posts',
            'destroy_posts',
            'view_detail_roles',
            'view_permissions',
            'view_users',
        ];

        foreach ($permissions as $permission) {
            Permission::updateOrCreate(['name' => $permission]);
        }

        $masterRole = Role::updateOrCreate(['name' => 'Master']);

        $allPermissions = Permission::pluck('id')->toArray();

        $masterRole->syncPermissions($allPermissions);
        
        $master = User::find(1);

        if ($master) {
            $master->assignRole($masterRole);
        }
    }
}
