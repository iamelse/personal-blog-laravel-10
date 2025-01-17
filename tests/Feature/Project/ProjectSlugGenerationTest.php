<?php

namespace Tests\Feature\Project;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Http\Response;
use Tests\TestCase;

class ProjectSlugGenerationTest extends TestCase
{
    use RefreshDatabase;

    /**
     * Test that the `checkSlug` method generates a unique slug.
     *
     * @return void
     */
    public function test_check_slug_creates_unique_slug()
    {
        $response1 = $this->json('GET', route('api.backend.project.check.slug'), ['title' => 'My Unique Project']);
        $response1->assertStatus(Response::HTTP_OK)
                  ->assertJsonStructure(['slug']);

        $slug1 = $response1->json('slug');
        $this->assertNotEmpty($slug1, 'Slug should not be empty.');

        $response2 = $this->json('GET', route('api.backend.project.check.slug'), ['title' => 'Another Unique Project']);
        $response2->assertStatus(Response::HTTP_OK)
                  ->assertJsonStructure(['slug']);

        $slug2 = $response2->json('slug');
        $this->assertNotEmpty($slug2, 'Slug should not be empty.');

        $this->assertNotEquals($slug1, $slug2, 'Slugs should be unique for different titles.');
    }

    /**
     * Test that the `checkSlug` method generates the same slug for the same title.
     *
     * @return void
     */
    public function test_check_slug_creates_same_slug_for_same_title()
    {
        $response1 = $this->json('GET', route('api.backend.project.check.slug'), ['title' => 'Project Title']);
        $response1->assertStatus(Response::HTTP_OK)
                  ->assertJsonStructure(['slug']);

        $slug1 = $response1->json('slug');
        $this->assertNotEmpty($slug1, 'Slug should not be empty.');

        $response2 = $this->json('GET', route('api.backend.project.check.slug'), ['title' => 'Project Title']);
        $response2->assertStatus(Response::HTTP_OK)
                  ->assertJsonStructure(['slug']);

        $slug2 = $response2->json('slug');
        $this->assertNotEmpty($slug2, 'Slug should not be empty.');

        $this->assertEquals($slug1, $slug2, 'Slugs should be the same for the same title.');
    }
}
