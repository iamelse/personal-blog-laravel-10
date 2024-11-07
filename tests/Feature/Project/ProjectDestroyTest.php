<?php

namespace Tests\Feature\Project;

use App\Models\Project;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Tests\TestCase;

class ProjectDestroyTest extends TestCase
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

    /**
     * Test that a user with the correct permissions can delete a project.
     */
    public function test_user_with_permission_can_destroy_project()
    {
        $deleteProjectPermission = Permission::firstOrCreate(['name' => 'destroy_projects']);

        $this->_create_user_and_logged_in_with_master_role($deleteProjectPermission);

        $project = Project::create([
            'title' => 'Test',
            'slug' => 'project-1',
            'desc' => 'blabla'
        ]);

        $this->assertDatabaseHas('projects', [
            'id' => $project->id,
            'title' => $project->title,
        ]);

        $response = $this->delete(route('backend.project.destroy', $project->id));

        $response->assertStatus(302);

        $this->assertEquals('Project deleted successfully', session('success'));

        $this->assertDatabaseMissing('projects', [
            'id' => $project->id,
        ]);
    }

    /**
     * Test that a user without permission cannot delete a project.
     */
    public function test_user_without_permission_cannot_destroy_project()
    {
        $user = $this->_create_user_and_logged_in();

        $project = Project::create([
            'title' => 'Test',
            'slug' => 'project-1',
            'desc' => 'blabla'
        ]);

        $response = $this->delete(route('backend.project.destroy', $project->id));

        $response->assertStatus(403);

        $this->assertDatabaseHas('projects', [
            'id' => $project->id,
            'title' => $project->title,
        ]);
    }

    /**
     * Test that a user with permission cannot delete a project that does not exist.
     */
    public function test_user_with_permission_cannot_destroy_non_existent_project()
    {
        $deleteProjectPermission = Permission::firstOrCreate(['name' => 'destroy_projects']);
        $user = $this->_create_user_and_logged_in_with_master_role($deleteProjectPermission);

        $nonExistentProjectId = 99999;

        $response = $this->delete(route('backend.project.destroy', $nonExistentProjectId));

        $response->assertStatus(404);

        $this->assertDatabaseMissing('projects', [
            'id' => $nonExistentProjectId,
        ]);
    }
}