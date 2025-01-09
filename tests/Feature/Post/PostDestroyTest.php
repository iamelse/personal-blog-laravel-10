<?php

namespace Tests\Feature\Post;

use App\Models\Post;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Tests\TestCase;

class PostDestroyTest extends TestCase
{
    use RefreshDatabase;

    /**
     * Create a user, assign the 'Master' role, grant a specific permission, and log them in.
     */
    protected function _create_user_and_logged_in_with_master_role($permission)
    {
        $masterRole = Role::firstOrCreate(['name' => 'Master']);
        $masterRole->givePermissionTo($permission);

        $user = User::factory()->create();
        $user->assignRole($masterRole);

        $this->actingAs($user);

        return $user;
    }

    /**
     * Create a user and log them in.
     */
    protected function _create_user_and_logged_in()
    {
        $user = User::factory()->create();
        $this->actingAs($user);

        return $user;
    }

    /**
     * Test that a user with the correct permissions can delete a post.
     */
    public function test_user_with_permission_can_destroy_post()
    {
        $deletePostPermission = Permission::firstOrCreate(['name' => 'destroy_posts']);

        $this->_create_user_and_logged_in_with_master_role($deletePostPermission);

        $post = Post::factory()->create();

        $this->assertDatabaseHas('posts', [
            'id' => $post->id,
            'title' => $post->title,
        ]);

        $response = $this->delete(route('post.destroy', $post->id));

        $response->assertStatus(302);
        $this->assertEquals('Post deleted successfully', session('success'));

        $this->assertDatabaseMissing('posts', [
            'id' => $post->id,
        ]);
    }

    /**
     * Test that a user without permission cannot delete a post.
     */
    public function test_user_without_permission_cannot_destroy_post()
    {
        $user = $this->_create_user_and_logged_in();

        $post = Post::factory()->create();

        $response = $this->delete(route('post.destroy', $post->id));

        $response->assertStatus(403);

        $this->assertDatabaseHas('posts', [
            'id' => $post->id,
            'title' => $post->title,
        ]);
    }

    /**
     * Test that a user with permission cannot delete a non-existent post.
     */
    public function test_user_with_permission_cannot_destroy_non_existent_post()
    {
        $deletePostPermission = Permission::firstOrCreate(['name' => 'destroy_posts']);

        $this->_create_user_and_logged_in_with_master_role($deletePostPermission);

        $nonExistentPostId = 99999;

        $response = $this->delete(route('post.destroy', $nonExistentPostId));

        $response->assertStatus(404);

        $this->assertDatabaseMissing('posts', [
            'id' => $nonExistentPostId,
        ]);
    }
}