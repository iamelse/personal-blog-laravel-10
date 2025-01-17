<?php

namespace Tests\Feature\Post;

use App\Models\PostCategory;
use App\Models\User;
use App\Enums\PostStatus;
use App\Models\Post;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;

class PostStoreTest extends TestCase
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
     * Test that the create method works as expected.
     */
    public function test_create_post_page_is_accessible(): void
    {
        $user = $this->_create_user_and_logged_in_with_master_role('create_posts');

        $categories = PostCategory::factory()->count(3)->create();

        $response = $this->get(route('post.create'));

        $response->assertStatus(200);

        $response->assertViewIs('backend.article.create');

        $response->assertViewHas('title', 'New Post');
        $response->assertViewHas('categories', function ($viewCategories) use ($categories) {
            return $categories->pluck('id')->diff($viewCategories->pluck('id'))->isEmpty();
        });
    }

    /**
     * Test the post store functionality for a directly published post.
     */
    public function test_post_store_creates_directly_published_post(): void
    {
        $user = $this->_create_user_and_logged_in_with_master_role('create_posts');

        Storage::fake(env('FILESYSTEM_DISK', 'public'));

        $category = PostCategory::factory()->create();

        $coverImage = UploadedFile::fake()->image('cover.jpg');
        $requestData = [
            'post_category_id' => $category->id,
            'title' => 'Published Post',
            'slug' => 'published-post',
            'content' => 'This is the body of the published post.',
            'published_at' => NULL, // Set it to null for immediate publish
            'cover' => $coverImage,
        ];

        $response = $this->post(route('post.store'), $requestData);

        $response->assertStatus(302);
        $response->assertSessionHasNoErrors();

        $this->assertDatabaseHas('posts', [
            'post_category_id' => $category->id,
            'title' => 'Published Post',
            'slug' => 'published-post',
            'body' => 'This is the body of the published post.',
            'user_id' => $user->id,
            'status' => PostStatus::PUBLISHED->value,
        ]);

        $post = Post::where('slug', 'published-post')->first();
        Storage::disk(env('FILESYSTEM_DISK', 'public'))->assertExists($post->cover);
    }

    /**
     * Test the post store functionality for a scheduled post.
     */
    public function test_post_store_creates_scheduled_post(): void
    {
        $user = $this->_create_user_and_logged_in_with_master_role('create_posts');

        Storage::fake(env('FILESYSTEM_DISK', 'public'));

        $category = PostCategory::factory()->create();

        $coverImage = UploadedFile::fake()->image('cover.jpg');
        $scheduledDate = now()->addDays(3); // Future date
        $requestData = [
            'post_category_id' => $category->id,
            'title' => 'Scheduled Post',
            'slug' => 'scheduled-post',
            'content' => 'This is the body of the scheduled post.',
            'published_at' => $scheduledDate,
            'cover' => $coverImage,
        ];

        $response = $this->post(route('post.store'), $requestData);

        $response->assertStatus(302);
        $response->assertSessionHasNoErrors();

        $this->assertDatabaseHas('posts', [
            'post_category_id' => $category->id,
            'title' => 'Scheduled Post',
            'slug' => 'scheduled-post',
            'body' => 'This is the body of the scheduled post.',
            'user_id' => $user->id,
            'published_at' => $scheduledDate,
            'status' => PostStatus::SCHEDULED->value,
        ]);

        $post = Post::where('slug', 'scheduled-post')->first();
        Storage::disk(env('FILESYSTEM_DISK', 'public'))->assertExists($post->cover);
    }

    /**
     * Test that the store method fails when the user is not logged in.
     */
    public function test_post_store_fails_when_user_is_not_logged_in(): void
    {
        $response = $this->post(route('post.store'), [
            'post_category_id' => 1,
            'title' => 'Sample Post',
            'slug' => 'sample-post',
            'content' => 'Sample content.',
            'published_at' => now(),
        ]);

        $response->assertStatus(302); // Redirect to login
        $response->assertRedirect(route('login')); // Ensure redirection to the login page
    }

    /**
     * Test that the store method fails when the user lacks the required permission.
     */
    public function test_post_store_fails_when_user_lacks_permission(): void
    {
        // Create and log in a user without the 'create_posts' permission
        $user = $this->_create_user_and_logged_in();

        $response = $this->post(route('post.store'), [
            'post_category_id' => 1,
            'title' => 'Sample Post',
            'slug' => 'sample-post',
            'content' => 'Sample content.',
            'published_at' => now(),
        ]);

        $response->assertStatus(403); // Forbidden
    }

    /**
     * Test that the store method fails when required fields are missing.
     */
    public function test_post_store_fails_due_to_missing_fields(): void
    {
        $user = $this->_create_user_and_logged_in_with_master_role('create_posts');

        $response = $this->post(route('post.store'), []);

        $response->assertStatus(302);
        $response->assertSessionHasErrors([
            'post_category_id',
            'title',
            'slug',
            'content',
        ]);
    }

    /**
     * Test that the store method fails with invalid data types.
     */
    public function test_post_store_fails_due_to_invalid_data_types(): void
    {
        $user = $this->_create_user_and_logged_in_with_master_role('create_posts');

        // Scenario: Invalid data types
        $response = $this->post(route('post.store'), [
            'post_category_id' => 'invalid', // Should be an integer
            'title' => '', // Required field
            'slug' => 12345, // Should be a string
            'content' => '', // Required field
            'published_at' => 'not-a-date', // Should be a valid date or null
            'cover' => null, // If required, this will fail
        ]);

        $response->assertStatus(302); // Redirection back due to validation errors
        $response->assertSessionHasErrors([
            'post_category_id', // Invalid type
            'title', // Required
            'slug', // Should be a string
            'content', // Required
            'published_at', // Invalid date
            'cover', // Required if applicable
        ]);
    }

    /**
     * Test that the store method fails when the uploaded file is invalid.
     */
    public function test_post_store_fails_with_invalid_file_upload(): void
    {
        $user = $this->_create_user_and_logged_in_with_master_role('create_posts');

        Storage::fake(env('FILESYSTEM_DISK', 'public'));

        $category = PostCategory::factory()->create();

        $response = $this->post(route('post.store'), [
            'post_category_id' => $category->id,
            'title' => 'Post with invalid file',
            'slug' => 'post-with-invalid-file',
            'content' => 'This post has an invalid file.',
            'published_at' => now(),
            'cover' => 'not-a-file', // Invalid file
        ]);

        $response->assertStatus(302);
        $response->assertSessionHasErrors(['cover']);
    }

    /**
     * Test that the store method fails with duplicate slug.
     */
    public function test_post_store_fails_with_duplicate_slug(): void
    {
        $user = $this->_create_user_and_logged_in_with_master_role('create_posts');

        $category = PostCategory::factory()->create();

        $this->post(route('post.store'), [
            'cover' => UploadedFile::fake()->image('cover.jpg'),
            'post_category_id' => $category->id,
            'title' => 'Original Post',
            'slug' => 'duplicate-slug',
            'content' => 'Original content.',
            'published_at' => NULL,
        ]);

        $response = $this->post(route('post.store'), [
            'cover' => UploadedFile::fake()->image('cover.jpg'),
            'post_category_id' => $category->id,
            'title' => 'Duplicate Slug Post',
            'slug' => 'duplicate-slug',
            'content' => 'This content has a duplicate slug.',
            'published_at' => NULL,
        ]);

        $response->assertStatus(302);
        $response->assertSessionHasErrors(['slug']);
    }
}