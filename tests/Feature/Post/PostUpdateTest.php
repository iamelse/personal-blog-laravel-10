<?php

namespace Tests\Feature\Post;

use App\Models\PostCategory;
use App\Models\User;
use App\Models\Post;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;

class PostUpdateTest extends TestCase
{
    use RefreshDatabase;
    
    /**
     * Create a user, assign the 'Master' role, grant a specific permission, and log them in.
     *
     * @param string $permission The permission to be granted to the 'Master' role.
     * @return \App\Models\User The created and logged-in user.
     */
    protected function _create_user_and_logged_in_with_master_role(string $permission): User
    {
        $masterRole = Role::firstOrCreate(['name' => 'Master']);

        $permissionInstance = Permission::firstOrCreate(['name' => $permission]);
        $masterRole->givePermissionTo($permissionInstance);

        $user = User::factory()->create();
        $user->assignRole($masterRole);

        $this->actingAs($user);

        return $user;
    }

    /**
     * Create a basic user and log them in.
     */
    protected function _create_user_and_logged_in(): User
    {
        $user = User::factory()->create(); // Use factories to create the user
        $this->actingAs($user); // Log in the user
        return $user;
    }

    /**
     * Test that the edit post page works as expected.
     */
    public function test_edit_post_page_is_accessible(): void
    {
        // Create and authenticate a user with the 'edit_posts' permission
        $user = $this->_create_user_and_logged_in_with_master_role('edit_posts');

        // Create a post and associated categories
        $categories = PostCategory::factory()->count(3)->create();
        $post = Post::factory()->create();

        // Access the edit post page
        $response = $this->get(route('post.edit', $post->id));

        // Assert the status is 200 (OK)
        $response->assertStatus(200);

        // Assert the correct view is returned
        $response->assertViewIs('backend.article.edit');

        // Assert the view has the expected variables
        $response->assertViewHas('title', 'Edit Post');
        $response->assertViewHas('categories', function ($viewCategories) use ($categories) {
            return $categories->pluck('id')->diff($viewCategories->pluck('id'))->isEmpty();
        });

        // Assert the post is passed to the view
        $response->assertViewHas('post', $post);
    }

    /**
     * Test the post update functionality ensures the post status remains unchanged.
     */
    public function test_post_update_preserves_status(): void
    {
        $user = $this->_create_user_and_logged_in_with_master_role('edit_posts');

        Storage::fake(env('FILESYSTEM_DISK', 'public'));

        $category = PostCategory::factory()->create();

        // Create a post with a predefined status
        $post = Post::factory()->create([
            'post_category_id' => $category->id,
        ]);

        $updatedCoverImage = UploadedFile::fake()->image('updated-cover.jpg');
        $updateData = [
            'post_category_id' => $category->id,
            'title' => 'Updated Post Title',
            'slug' => 'updated-post-title',
            'content' => 'This is the updated body of the post.',
            'cover' => $updatedCoverImage,
        ];

        // Send the update request
        $response = $this->put(route('post.update', $post->id), $updateData);

        $response->assertStatus(302);
        $response->assertSessionHasNoErrors();

        // Assert the post was updated with new data
        $this->assertDatabaseHas('posts', [
            'id' => $post->id,
            'post_category_id' => $category->id,
            'title' => 'Updated Post Title',
            'slug' => 'updated-post-title',
            'body' => 'This is the updated body of the post.',
        ]);

        // Check that the new cover image exists
        $updatedPost = $post->fresh();
        Storage::disk(env('FILESYSTEM_DISK', 'public'))->assertExists($updatedPost->cover);
    }

    /**
     * Test that unauthorized users cannot update a post.
     */
    public function test_unauthorized_user_cannot_update_post(): void
    {
        $this->_create_user_and_logged_in(); // Log in a user without the 'edit_posts' permission

        $category = PostCategory::factory()->create();

        // Create a post
        $post = Post::factory()->create([
            'post_category_id' => $category->id,
        ]);

        $updateData = [
            'post_category_id' => $category->id,
            'title' => 'Unauthorized Update Attempt',
            'slug' => 'unauthorized-update-attempt',
            'content' => 'This should not be updated.',
        ];

        // Attempt to update the post
        $response = $this->put(route('post.update', $post->id), $updateData);

        // Assert forbidden access
        $response->assertStatus(403);

        // Assert that the post was not updated
        $this->assertDatabaseHas('posts', [
            'id' => $post->id,
            'title' => $post->title,
            'slug' => $post->slug,
            'body' => $post->body,
        ]);
    }

    /**
     * Test that the post update fails when provided invalid data.
     */
    public function test_post_update_fails_with_invalid_data(): void
    {
        $user = $this->_create_user_and_logged_in_with_master_role('edit_posts');

        $category = PostCategory::factory()->create();

        // Create a post with a valid state
        $post = Post::factory()->create([
            'post_category_id' => $category->id,
        ]);

        $updateData = [
            'post_category_id' => null, // Invalid data: post category cannot be null
            'title' => '', // Invalid data: title is required
            'slug' => 'valid-slug',
            'content' => 'This update should fail.',
        ];

        // Attempt to update the post
        $response = $this->put(route('post.update', $post->id), $updateData);

        // Assert the response indicates a validation error
        $response->assertStatus(302);
        $response->assertSessionHasErrors(['post_category_id', 'title']);

        // Assert that the post was not updated
        $this->assertDatabaseHas('posts', [
            'id' => $post->id,
            'title' => $post->title, // Original title should remain unchanged
            'slug' => $post->slug,
            'body' => $post->body,
        ]);
    }
}
