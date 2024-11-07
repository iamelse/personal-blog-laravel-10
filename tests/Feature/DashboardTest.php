<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Tests\TestCase;

class DashboardTest extends TestCase
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

    /**
     * Test that a user with 'view_dashboard' permission can access the dashboard.
     */
    public function test_user_with_permission_can_access_dashboard()
    {
        $viewDashboardPermission = Permission::firstOrCreate(['name' => 'view_dashboard']);

        $this->_create_user_and_logged_in_with_master_role($viewDashboardPermission);

        $response = $this->get(route('dashboard'));

        $response->assertStatus(200);
        $response->assertViewIs('backend.dashboard.index');
    }

    /**
     * Test that a user without 'view_dashboard' permission cannot access the dashboard.
     */
    public function test_user_without_permission_cannot_access_dashboard()
    {
        $this->_create_user_and_logged_in();

        $response = $this->get(route('dashboard'));

        $response->assertStatus(403);
    }
}
