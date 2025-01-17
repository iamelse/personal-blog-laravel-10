<?php

namespace Tests\Feature\Project;

use App\Models\Project;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Tests\TestCase;

class ProjectIndexTest extends TestCase
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
     * Test that a user with 'view_projects' permission can access the project.
     */
    public function test_user_with_permission_can_access_project()
    {
        $viewProjectPermission = Permission::firstOrCreate(['name' => 'view_projects']);

        $this->_create_user_and_logged_in_with_master_role($viewProjectPermission);

        $response = $this->get(route('backend.project.index'));

        $response->assertStatus(200);
        $response->assertViewIs('backend.project.index');
    }

    /**
     * Test that a user without 'view_projects' permission cannot access the project.
     */
    public function test_user_without_permission_cannot_access_project()
    {
        $this->_create_user_and_logged_in();

        $response = $this->get(route('backend.project.index'));

        $response->assertStatus(403);
    }

    /**
     * Test that the index method returns a list of projects without a search term.
     *
     * @return void
     */
    public function test_index_returns_projects_without_search_term()
    {
        $viewProjectPermission = Permission::firstOrCreate(['name' => 'view_projects']);

        $this->_create_user_and_logged_in_with_master_role($viewProjectPermission);

        $project1 = Project::create(['title' => 'Project 1', 'slug' => 'project-1']);
        $project2 = Project::create(['title' => 'Project 2', 'slug' => 'project-2']);
        $project3 = Project::create(['title' => 'Project 3', 'slug' => 'project-3']);

        $response = $this->get(route('backend.project.index', ['limit' => 2]));

        $response->assertStatus(200);

        // Assert that 'Project 1' and 'Project 2' are visible
        $response->assertSee($project1->title);
        $response->assertSee($project2->title);

        // Assert that 'Project 3' is NOT visible on the first page
        $response->assertDontSee($project3->title);
    }

    public function test_index_returns_projects_with_search_term()
    {
        $viewProjectPermission = Permission::firstOrCreate(['name' => 'view_projects']);

        $this->_create_user_and_logged_in_with_master_role($viewProjectPermission);

        $project1 = Project::create(['title' => 'Project 1', 'slug' => 'project-1']);
        $project2 = Project::create(['title' => 'Project 2', 'slug' => 'project-2']);
        $project3 = Project::create(['title' => 'Project 3', 'slug' => 'project-3']);

        $response = $this->get(route('backend.project.index', ['limit' => 2, 'q' => 'Project 1']));

        $response->assertStatus(200);

        // Assert that 'Project 1' is visible
        $response->assertSee($project1->title);

        // Assert that 'Project 2' and 'Project 3' are NOT visible
        $response->assertDontSee($project2->title);
        $response->assertDontSee($project3->title);
    }
}
