<?php

namespace Tests\Feature\Project;

use App\Models\Project;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Tests\TestCase;

class ProjectUpdateTest extends TestCase
{
    use RefreshDatabase;

    /**
     * Create a user, assign the 'Master' role, grant a specific permission, and log them in.
     *
     * This method creates a user, assigns the 'Master' role (if it doesn't already exist),
     * grants the user the specified permission, and logs them in for subsequent tests.
     *
     * @param string $permission The permission to be granted to the 'Master' role.
     * @return \App\Models\User The created and logged-in user.
     */
    protected function _create_user_and_logged_in_with_master_role($permission)
    {
        $masterRole = Role::firstOrCreate(['name' => 'Master']);
        $masterRole->givePermissionTo($permission);

        $user = User::create();
        $user->assignRole($masterRole);

        $this->actingAs($user);

        return $user;
    }

    /**
     * Create a user and log them in.
     *
     * This method creates a user and logs them in via `$this->actingAs($user)` for subsequent tests.
     * This method is typically used for testing scenarios where a user does not need a specific role or permission.
     *
     * @return \App\Models\User The created and logged-in user.
     */
    protected function _create_user_and_logged_in()
    {
        $user = User::create();

        $this->actingAs($user);

        return $user;
    }

    public function test_user_with_permission_can_access_edit_project()
    {
        $editProjectPermission = Permission::firstOrCreate(['name' => 'edit_projects']);

        $this->_create_user_and_logged_in_with_master_role($editProjectPermission);

        $project = Project::create([
            'title' => 'Test Project',
            'slug' => 'test-project',
            'desc' => 'This is a description for the test project.',
        ]);

        $response = $this->get(route('backend.project.edit', $project->id));

        $response->assertStatus(200);

        $response->assertViewIs('backend.project.edit');
    }

    /**
     * Test that a user without 'edit_projects' permission cannot access the edit project page.
     */
    public function test_user_without_permission_cannot_access_edit_project()
    {
        $this->_create_user_and_logged_in();

        $project = Project::create([
            'title' => 'Test Project',
            'slug' => 'test-project',
            'desc' => 'This is a description for the test project.',
        ]);

        $response = $this->get(route('backend.project.edit', $project->id));

        $response->assertStatus(403);
    }
}
