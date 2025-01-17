<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Tests\TestCase;

class AboutTest extends TestCase
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
        // Create or retrieve the 'Master' role and grant the specified permission
        $masterRole = Role::firstOrCreate(['name' => 'Master']);
        $masterRole->givePermissionTo($permission);

        // Create the user and assign the 'Master' role
        $user = User::create();
        $user->assignRole($masterRole);

        // Log the user in for subsequent requests
        $this->actingAs($user);

        // Return the created user instance
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

    /** POSITIVE CASE */

    /**
     * Test that a user with 'view_about' permission can access the about page.
     */
    public function test_user_with_permission_can_access_about()
    {
        $viewAboutPermission = Permission::firstOrCreate(['name' => 'view_about']);

        $this->_create_user_and_logged_in_with_master_role($viewAboutPermission);

        $response = $this->get(route('backend.about.index'));

        $response->assertStatus(200);
        $response->assertViewIs('backend.about.index');
    }

    /**
     * Test that a user with 'update_about' permission can update the about.
     */
    public function test_user_with_permission_can_update_about()
    {
        $updateAboutPermission = Permission::firstOrCreate(['name' => 'update_about']);

        $this->_create_user_and_logged_in_with_master_role($updateAboutPermission);

        $updateData = [
            'content' => 'Updated content for the about section.'
        ];

        $response = $this->put(route('backend.about.update'), $updateData);
        
        $response->assertRedirect(route('backend.about.index'));
        $this->assertEquals('About updated successfully', session('success'));
        $this->assertDatabaseHas('abouts', ['body' => $updateData['content']]);
    }

    /** NEGATIVE CASE */

    /**
     * Test that a user without 'view_about' permission cannot access the about.
     */
    public function test_user_without_permission_cannot_access_about()
    {
        $this->_create_user_and_logged_in();

        $response = $this->get(route('backend.about.index'));

        $response->assertStatus(403);
    }

    /**
     * Test that a user without 'update_about' permission cannot update the about.
     */
    public function test_user_without_permission_cannot_update_about()
    {
        $this->_create_user_and_logged_in();

        $updateData = [
            'content' => 'Attempting to update without permission.'
        ];

        $response = $this->put(route('backend.about.update'), $updateData);

        $response->assertStatus(403);
    }

    public function test_user_cannot_update_an_empty_content_about()
    {
        $updateAboutPermission = Permission::firstOrCreate(['name' => 'update_about']);

        $this->_create_user_and_logged_in_with_master_role($updateAboutPermission);

        $updateData = [
            'content' => ''
        ];

        $response = $this->put(route('backend.about.update'), $updateData);

        $response->assertStatus(302);

        $response->assertSessionHasErrors('content');
    }
}
