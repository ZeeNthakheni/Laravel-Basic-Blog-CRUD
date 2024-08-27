<?php

namespace Tests\Feature\Post;

use App\Models\User;
use App\Models\Post;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class PostCreateTest extends TestCase
{
    use RefreshDatabase;

    /**
     * A basic feature test example.
     */
    public function testUserCanCreatePost()
    {
        // Authenticate a user
        $user = User::factory()->create();
        $this->actingAs($user);

        // Prepare post data
        $postData = [
            'title' => 'Test Post Title',
            'content' => 'Test Post Content',
        ];

        // Make a POST request to the post creation route
        $response = $this->withHeaders(['Accept' => 'application/json'])->post('/posts', $postData);

        // Assert the post was created
        $this->assertDatabaseHas('posts', [
            'title' => $postData['title'],
            'content' => $postData['content'],
            'author_id' => $user->id,
        ]);

        // Assert the response is successful
        $response->assertStatus(302)->assertRedirect('/home');
    }
}
