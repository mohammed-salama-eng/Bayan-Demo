<?php

namespace Tests\Feature;

use App\Models\Post;
use App\Models\User;
use Database\Seeders\RolesAndPermissionsSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class PostTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();
        $this->seed(RolesAndPermissionsSeeder::class);
    }

    public function test_user_can_view_posts_listing(): void
    {
        $user = User::factory()->create();
        Post::factory()->count(3)->create(['user_id' => $user->id]);

        $response = $this->actingAs($user)->get(route('posts.index'));

        $response->assertOk();
        $response->assertViewHas('posts');
    }

    public function test_user_with_permission_can_create_post(): void
    {
        $user = User::factory()->create();
        $user->assignRole('editor');

        $response = $this->actingAs($user)->post(route('posts.store'), [
            'title' => 'Test Post Title',
            'content' => 'This is a test post content.',
        ]);

        $response->assertRedirect(route('posts.index'));
        $this->assertDatabaseHas('posts', [
            'title' => 'Test Post Title',
            'user_id' => $user->id,
        ]);
    }

    public function test_user_without_permission_cannot_create_post(): void
    {
        $user = User::factory()->create();

        $response = $this->actingAs($user)->get(route('posts.create'));

        $response->assertForbidden();
    }

    public function test_owner_can_edit_their_post(): void
    {
        $user = User::factory()->create();
        $user->assignRole('editor');
        $post = Post::factory()->create(['user_id' => $user->id]);

        $response = $this->actingAs($user)->put(route('posts.update', $post), [
            'title' => 'Updated Title',
            'content' => 'Updated content.',
        ]);

        $response->assertRedirect(route('posts.show', $post));
        $this->assertDatabaseHas('posts', [
            'id' => $post->id,
            'title' => 'Updated Title',
        ]);
    }

    public function test_non_owner_cannot_edit_others_post(): void
    {
        $owner = User::factory()->create();
        $other = User::factory()->create();
        $other->assignRole('editor');
        $post = Post::factory()->create(['user_id' => $owner->id]);

        $response = $this->actingAs($other)->get(route('posts.edit', $post));

        $response->assertForbidden();
    }

    public function test_admin_can_edit_any_post(): void
    {
        $owner = User::factory()->create();
        $admin = User::factory()->create();
        $admin->assignRole('admin');
        $post = Post::factory()->create(['user_id' => $owner->id]);

        $response = $this->actingAs($admin)->get(route('posts.edit', $post));

        $response->assertOk();
    }

    public function test_owner_can_delete_their_post(): void
    {
        $user = User::factory()->create();
        $user->assignRole('editor');
        $post = Post::factory()->create(['user_id' => $user->id]);

        $response = $this->actingAs($user)->delete(route('posts.destroy', $post));

        $response->assertRedirect(route('posts.index'));
        $this->assertDatabaseMissing('posts', ['id' => $post->id]);
    }

    public function test_guest_is_redirected_to_login(): void
    {
        $response = $this->get(route('posts.index'));

        $response->assertRedirect(route('login'));
    }
}
