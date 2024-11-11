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
        // Master permissions
        $masterPermissions = [
            'view_dashboard',
            'view_home',
            'update_home',
            'update_image_home',
            'view_about',
            'update_about',
            'view_projects',
            'create_projects',
            'edit_projects',
            'destroy_projects',
            'view_post_categories',
            'create_post_categories',
            'edit_post_categories',
            'destroy_post_categories',
            'view_posts',
            'create_posts',
            'edit_posts',
            'destroy_posts',
            'mass_destroy_posts',
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
            // 'view_permissions',
            // 'create_permissions',
            'view_users',
            'create_users',
            'edit_users',
            'destroy_users',
            'view_developer',
            'view_information',
            'go_to_laravel_filemanager',
            'view_log_activity'
        ];

        // Author permissions
        $authorPermissions = [
            'view_dashboard',
            'view_post_categories',
            'create_post_categories',
            'view_posts',
            'create_posts',
            'edit_posts',
            'destroy_posts',
        ];

        // Ensure Master permissions are created or updated
        foreach ($masterPermissions as $permission) {
            Permission::updateOrCreate(['name' => $permission]);
        }

        // Create or update the Master role and assign all permissions
        $masterRole = Role::updateOrCreate(['name' => 'Master']);
        $allPermissions = Permission::pluck('id')->toArray();
        $masterRole->syncPermissions($allPermissions);

        // Assign Master role to the user with ID 1
        $master = User::find(1);
        if ($master) {
            $master->assignRole($masterRole);
        }

        // Ensure Author permissions are created or updated
        foreach ($authorPermissions as $permission) {
            Permission::updateOrCreate(['name' => $permission]);
        }

        // Create or update the Author role and assign specific permissions
        $authorRole = Role::updateOrCreate(['name' => 'Author']);
        $authorRolePermissions = Permission::whereIn('name', $authorPermissions)->pluck('id')->toArray();
        $authorRole->syncPermissions($authorRolePermissions);

        // Assign Author role to the user with ID 2 (or any other ID)
        $author = User::find(2); // Assuming User 2 is the author
        if ($author) {
            $author->assignRole($authorRole);
        }
    }
}
