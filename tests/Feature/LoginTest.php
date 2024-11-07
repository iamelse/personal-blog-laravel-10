<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class LoginTest extends TestCase
{
    use RefreshDatabase;

    /**
     * Test that the login page is accessible.
     */
    public function test_login_page_is_accessible()
    {
        $user = User::factory()->create([
            'email' => 'tatang@gmail.com',
            'password' => bcrypt('password'),
        ]);

        $response = $this->get(route('login'));

        $response->assertStatus(200);
        $response->assertViewIs('auth.login');
    }

    /**
     * Test that a user can log in with valid credentials.
     */
    public function test_user_can_log_in_with_valid_credentials()
    {
        $user = User::factory()->create([
            'email' => 'tatang@gmail.com',
            'password' => bcrypt('password'),
        ]);

        $response = $this->post(route('authenticate'), [
            'email' => 'tatang@gmail.com',
            'password' => 'password',
        ]);

        $response->assertStatus(302);
        $response->assertRedirect(route('dashboard'));
        $this->assertAuthenticatedAs($user);
    }

    /**
     * Test that a user cannot log in with invalid credentials.
     */
    public function test_user_cannot_log_in_with_invalid_credentials()
    {
        $user = User::factory()->create([
            'email' => 'tatang@gmail.com',
            'password' => bcrypt('password'),
        ]);

        $response = $this->post(route('authenticate'), [
            'email' => 'tatang@gmail.com',
            'password' => 'wrongpassword',
        ]);

        $response->assertStatus(302);
        $response->assertSessionHasErrors('email');
        $this->assertGuest();
    }

    /**
     * Test that a user cannot log in with invalid email format.
     */
    public function test_user_cannot_log_in_with_invalid_email_format()
    {
        $response = $this->post(route('authenticate'), [
            'email' => 'invalid-email-format',
            'password' => 'password',
        ]);

        $response->assertStatus(302);
        $response->assertSessionHasErrors('email');
    }
}