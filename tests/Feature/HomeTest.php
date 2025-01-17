<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Tests\TestCase;

class HomeTest extends TestCase
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
     * Test that a user with 'view_home' permission can access the home.
     */
    public function test_user_with_permission_can_access_home()
    {
        $viewHomePermission = Permission::firstOrCreate(['name' => 'view_home']);

        $this->_create_user_and_logged_in_with_master_role($viewHomePermission);

        $response = $this->get(route('backend.home.index'));

        $response->assertStatus(200);
        $response->assertViewIs('backend.home.index');
    }

    /**
     * Test that a user with 'update_home' permission can update the home.
     */
    public function test_user_with_permission_can_update_home()
    {
        $updateHomePermission = Permission::firstOrCreate(['name' => 'update_home']);

        $this->_create_user_and_logged_in_with_master_role($updateHomePermission);
        
        $updateData = [
            'content' => 'Updated content for the home section.'
        ];

        $response = $this->put(route('backend.home.update'), $updateData);
        
        $response->assertRedirect(route('backend.home.index'));
        $this->assertEquals('Home updated successfully', session('success'));
        $this->assertDatabaseHas('homes', ['body' => $updateData['content']]);
    }

    /**
     * Test that a user with 'update_image_home' permission can update the home with an image.
     */
    public function test_user_with_permission_can_update_home_with_image()
    {
        $updateHomePermission = Permission::firstOrCreate(['name' => 'update_image_home']);

        $this->_create_user_and_logged_in_with_master_role($updateHomePermission);

        Storage::fake('public');

        $image = UploadedFile::fake()->image('test-image.jpg');

        $response = $this->put(route('backend.home.update.image'), [
            'radioType' => 'image', 
            'imageInput' => $image,
        ]);

        $response->assertStatus(302);
        $response->assertSessionHas('success', 'Home updated successfully');

        $this->assertTrue(Storage::disk('public')->exists('uploads/home/' . $image->hashName()), 'The image should exist in storage.');

        $this->assertDatabaseHas('homes', [
            'image' => 'uploads/home/' . $image->hashName(),
        ]);
    }

    /** NEGATIVE CASE */

    /**
     * Test that a user without 'view_home' permission cannot access the home.
     */
    public function test_user_without_permission_cannot_access_home()
    {
        $this->_create_user_and_logged_in();

        $response = $this->get(route('backend.home.index'));

        $response->assertStatus(403);
    }

    /**
     * Test that a user without 'update_home' permission cannot update the home.
     */
    public function test_user_without_permission_cannot_update_home()
    {
        $this->_create_user_and_logged_in();

        $updateData = [
            'content' => 'Attempting to update without permission.'
        ];

        $response = $this->put(route('backend.home.update'), $updateData);

        $response->assertStatus(403);
    }

    /**
     * Test that a user without 'update_image_home' permission cannot update the home with an image.
     */
    public function test_user_without_permission_cannot_update_home_with_image()
    {
        $this->_create_user_and_logged_in();

        Storage::fake('public');

        $image = UploadedFile::fake()->image('test-image.jpg');

        $response = $this->put(route('backend.home.update.image'), [
            'radioType' => 'image',
            'imageInput' => $image,
        ]);

        $response->assertStatus(403);

        $this->assertFalse(Storage::disk('public')->exists('uploads/home/' . $image->hashName()), 'The image should not exist in storage.');

        $this->assertDatabaseMissing('homes', [
            'image' => 'uploads/home/' . $image->hashName(),
        ]);
    }

    /**
     * Test that a user with permission cannot update the home with an invalid image type.
     */
    public function test_user_with_permission_cannot_update_home_with_invalid_image()
    {
        $updateHomePermission = Permission::firstOrCreate(['name' => 'update_image_home']);
        
        $this->_create_user_and_logged_in_with_master_role($updateHomePermission);

        $response = $this->put(route('backend.home.update.image'), [
            'radioType' => 'image',
            'imageInput' => UploadedFile::fake()->create('test-document.pdf', 100),
        ]);

        $response->assertStatus(302);
        $response->assertSessionHasErrors(['imageInput']);
    }

    /**
     * Test that a user cannot upload an oversized image.
     */
    public function test_user_cannot_upload_oversized_image()
    {
        $updateHomePermission = Permission::firstOrCreate(['name' => 'update_image_home']);

        $this->_create_user_and_logged_in_with_master_role($updateHomePermission);

        Storage::fake('public');

        $image = UploadedFile::fake()->image('oversized-image.jpg')->size(2 * 2048); // 4MB

        $response = $this->put(route('backend.home.update.image'), [
            'radioType' => 'image',
            'imageInput' => $image,
        ]);

        $response->assertStatus(302);
        $response->assertSessionHasErrors(['imageInput']);
        $this->assertFalse(Storage::disk('public')->exists('uploads/home/' . $image->hashName()), 'The oversized image should not exist in storage.');
    }
}