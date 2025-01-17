<?php

namespace Tests\Feature\Project;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Tests\TestCase;

class ProjectStoreTest extends TestCase
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
     * Test that a user with 'create_projects' permission can access the create project page.
     */
    public function test_user_with_permission_can_access_create_project()
    {
        $createProjectPermission = Permission::firstOrCreate(['name' => 'create_projects']);

        $this->_create_user_and_logged_in_with_master_role($createProjectPermission);

        $response = $this->get(route('backend.project.create'));

        $response->assertStatus(200);
        $response->assertViewIs('backend.project.create');
    }

    /**
     * Test that a user without 'create_projects' permission cannot access the create project page.
     */
    public function test_user_without_permission_cannot_access_create_project()
    {
        $this->_create_user_and_logged_in();

        $response = $this->get(route('backend.project.create'));

        $response->assertStatus(403);
    }

    /**
     * Test that a user with 'create_projects' permission can store the project.
     */
    public function test_user_with_permission_can_store_the_project()
    {
        $createProjectPermission = Permission::firstOrCreate(['name' => 'create_projects']);

        $this->_create_user_and_logged_in_with_master_role($createProjectPermission);

        $projectData = [
            'title' => 'New Project',
            'slug' => 'new-project',
            'content' => 'This is a description for the new project.'
        ];

        $response = $this->post(route('backend.project.store'), $projectData);

        $response->assertStatus(302);

        $this->assertEquals('Project created successfully', session('success'));

        $this->assertDatabaseHas('projects', [
            'title' => 'New Project',
            'slug' => 'new-project',
            'desc' => 'This is a description for the new project.'
        ]);
    }

    /**
     * Test that a user without 'create_projects' permission cannot store the project.
     */
    public function test_user_without_permission_cannot_store_the_project()
    {
        $this->_create_user_and_logged_in();

        $projectData = [
            'title' => 'New Project',
            'slug' => 'new-project',
            'content' => 'This is a description for the new project.'
        ];

        $response = $this->post(route('backend.project.store'), $projectData);

        $response->assertStatus(403);

        $this->assertDatabaseMissing('projects', [
            'title' => 'New Project',
            'slug' => 'new-project',
            'desc' => 'This is a description for the new project.'
        ]);
    }

    /**
     * Test that invalid input results in validation errors when trying to store the project.
     */
    public function test_invalid_input_cannot_store_project()
    {
        $createProjectPermission = Permission::firstOrCreate(['name' => 'create_projects']);
        $this->_create_user_and_logged_in_with_master_role($createProjectPermission);

        $invalidProjectData = [
            'title' => '',
            'slug' => '',
            'content' => '',
        ];

        $response = $this->post(route('backend.project.store'), $invalidProjectData);

        $response->assertStatus(302);

        $response->assertSessionHasErrors(['title', 'slug', 'content']);

        $response->assertSessionHasErrors([
            'title' => 'The title field is required.',
            'slug' => 'The slug field is required.',
            'content' => 'The content field is required.',
        ]);
    }

    /**
     * Test that a user cannot store a project with a duplicate slug.
     */
    public function test_duplicate_slug_cannot_store_project()
    {
        $createProjectPermission = Permission::firstOrCreate(['name' => 'create_projects']);
        $this->_create_user_and_logged_in_with_master_role($createProjectPermission);

        $firstProjectData = [
            'title' => 'First Project',
            'slug' => 'unique-slug',
            'content' => 'This is a description for the first project.'
        ];

        $this->post(route('backend.project.store'), $firstProjectData);

        $secondProjectData = [
            'title' => 'Second Project',
            'slug' => 'unique-slug',
            'content' => 'This is a description for the second project.'
        ];

        $response = $this->post(route('backend.project.store'), $secondProjectData);

        $response->assertStatus(302);

        $response->assertSessionHasErrors('slug');

        $response->assertSessionHasErrors([
            'slug' => 'The slug has already been taken.',
        ]);

        $this->assertDatabaseMissing('projects', [
            'title' => 'Second Project',
            'slug' => 'unique-slug',
            'desc' => 'This is a description for the second project.'
        ]);
    }
}
