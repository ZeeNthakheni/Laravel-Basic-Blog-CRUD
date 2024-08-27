<?php

namespace Tests\Feature\Post;

use App\Models\User;
use App\Models\Post;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class PostDeleteTest extends TestCase
{
    use RefreshDatabase;

    /**
     * Test if a user can delete a post.
     *
     * @return void
     */
    public function testUserCanDeletePost()
    {
        // Authenticate a user
        $user = User::factory()->create();
        $this->actingAs($user);

        // Create a post
        $post = Post::factory()->create(['author_id' => $user->id]);

        // Make a DELETE request to the post deletion route
        $response = $this->delete("/posts/{$post->id}");

        // Assert the post was deleted
        $this->assertDatabaseMissing('posts', ['id' => $post->id]);

        // Assert the response is successful
        $response->assertStatus(302)->assertRedirect('/home');

    }
}
