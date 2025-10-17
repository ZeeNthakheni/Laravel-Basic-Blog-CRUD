<?php

namespace Tests\Feature\Post;

use App\Models\Post;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class PostControllerTest extends TestCase
{
    use RefreshDatabase;

    public function test_can_view_a_list_of_posts()
    {
        $user = User::factory()->create();
        $posts = Post::factory()->count(3)->for($user, 'user')->create();

        $response = $this->actingAs($user)->get(route('posts.home'));

        $response->assertOk();
        $response->assertViewIs('posts.index');
        $response->assertViewHas('posts');

        $viewPosts = $response->viewData('posts');
        $this->assertEquals(3, $viewPosts->count());
        $this->assertTrue($viewPosts->contains($posts->first()));
    }

    public function test_create_post_page_is_displayed()
    {
        $user = User::factory()->create();

        $response = $this->actingAs($user)->get(route('posts.create'));

        $response->assertOk();
        $response->assertViewIs('posts.create');
    }

    public function test_can_view_a_single_post()
    {
        $user = User::factory()->create();
        $post = Post::factory()->for($user, 'user')->create();

        $response = $this->actingAs($user)->get(route('posts.show', $post));

        $response->assertOk();
        $response->assertViewIs('posts.show');
        $response->assertViewHas('post', $post);
    }

    public function test_can_view_edit_page_for_owned_post()
    {
        $user = User::factory()->create();
        $post = Post::factory()->for($user, 'user')->create();

        $response = $this->actingAs($user)->get(route('posts.edit', $post));

        $response->assertOk();
        $response->assertViewIs('posts.edit');
        $response->assertViewHas('post', $post);
    }

    public function test_cannot_view_edit_page_for_unowned_post()
    {
        $user = User::factory()->create();
        $otherUser = User::factory()->create();
        $post = Post::factory()->for($otherUser, 'user')->create();

        $response = $this->actingAs($user)->get(route('posts.edit', $post));

        $response->assertForbidden();
    }

    public function test_user_can_create_post()
    {
        $user = User::factory()->create();
        $this->actingAs($user);

        $postData = [
            'title' => 'Test Post Title',
            'content' => 'Test Post Content',
        ];

        $response = $this->post(route('posts.store'), $postData);

        $this->assertDatabaseHas('posts', [
            'title' => $postData['title'],
            'content' => $postData['content'],
            'author_id' => $user->id,
        ]);

        $response->assertRedirect(route('posts.home'));
    }

    public function test_user_can_update_post()
    {
        $user = User::factory()->create();
        $post = Post::factory()->for($user, 'user')->create();
        $this->actingAs($user);

        $updatedData = [
            'title' => 'Updated Title',
            'content' => 'Updated Content',
        ];

        $response = $this->patch(route('posts.update', $post), $updatedData);

        $post->refresh();

        $this->assertEquals($updatedData['title'], $post->title);
        $this->assertEquals($updatedData['content'], $post->content);

        $response->assertRedirect(route('posts.home'));
    }

    public function test_user_can_delete_post()
    {
        $user = User::factory()->create();
        $post = Post::factory()->for($user, 'user')->create();
        $this->actingAs($user);

        $response = $this->delete(route('posts.destroy', $post));

        $this->assertDatabaseMissing('posts', ['id' => $post->id]);

        $response->assertRedirect(route('posts.home'));
    }
}