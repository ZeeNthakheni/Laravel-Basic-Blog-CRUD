<?php

namespace Tests\Feature\Post;

use App\Models\User;
use App\Models\Post;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class PostUpdateTest extends TestCase
{
    use RefreshDatabase;

    /**
     * Test if a user can update a post.
     *
     * @return void
     */
    public function testUserCanUpdatePost()
    {
        // Authenticate a user
        $user = User::factory()->create();
        $this->actingAs($user);

        // Create a post
        $post = Post::factory()->create(['author_id' => $user->id]);

        // Prepare updated post data
        $updatedData = [
            'title' => 'Updated Title',
            'content' => 'Updated Content',
        ];

        // Make a patch request to the post update route
        $response = $this->patch("/posts/{$post->id}", $updatedData);

        // Assert the post was updated
        $post->refresh();
        $this->assertEquals($updatedData['title'], $post->title);
        $this->assertEquals($updatedData['content'], $post->content);

        // Assert the response is successful
        $response->assertStatus(302)->assertRedirect('/home');

    }
}
