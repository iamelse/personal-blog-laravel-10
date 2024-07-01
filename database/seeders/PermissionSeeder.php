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
            'view_home',
            'update_home',
            'update_image_home',
            'view_about',
            'update_about',
            'view_projects',
            'search_projects',
            'create_projects',
            'store_projects',
            'edit_projects',
            'update_projects',
            'destroy_projects',
            'view_post_categories',
            'create_post_categories',
            'edit_post_categories',
            'destroy_post_categories',
            'view_posts',
            'create_posts',
            'edit_posts',
            'destroy_posts',
            'view_education',
            'create_education',
            'edit_education',
            'destroy_education',
            'view_experience',
            'create_experience',
            'edit_experience',
            'destroy_experience',
            'view_technical_skills',
            'create_technical_skills',
            'edit_technical_skills',
            'destroy_technical_skills',
            'view_language_skills',
            'create_language_skills',
            'edit_language_skills',
            'destroy_language_skills',
            'view_roles',
            'view_detail_roles',
            //'view_permissions',
            //'create_permissions',
            'view_users',
            'create_users',
            'edit_users',
            'destroy_users',
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
