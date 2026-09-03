<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class PreferenceTest extends TestCase
{
    use RefreshDatabase;

    public function test_user_can_set_locale(): void
    {
        $user = User::factory()->create(['locale' => 'en']);

        $response = $this->actingAs($user)->get(route('locale.set', 'ar'));

        $response->assertRedirect();
        $this->assertDatabaseHas('users', [
            'id' => $user->id,
            'locale' => 'ar',
        ]);
    }

    public function test_user_can_set_theme(): void
    {
        $user = User::factory()->create(['theme' => 'light']);

        $response = $this->actingAs($user)->get(route('theme.set', 'dark'));

        $response->assertRedirect();
        $this->assertDatabaseHas('users', [
            'id' => $user->id,
            'theme' => 'dark',
        ]);
    }

    public function test_guest_can_set_locale_in_session(): void
    {
        $response = $this->get(route('locale.set', 'ar'));

        $response->assertRedirect();
        $this->assertSame('ar', session('locale'));
    }
}
