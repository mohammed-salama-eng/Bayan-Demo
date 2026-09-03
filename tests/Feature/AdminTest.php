<?php

namespace Tests\Feature;

use App\Models\User;
use Database\Seeders\RolesAndPermissionsSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Spatie\Permission\Models\Role;
use Tests\TestCase;

class AdminTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();
        $this->seed(RolesAndPermissionsSeeder::class);
    }

    public function test_admin_can_view_users_list(): void
    {
        $admin = User::factory()->create();
        $admin->assignRole('admin');

        $response = $this->actingAs($admin)->get(route('admin.users.index'));

        $response->assertOk();
        $response->assertViewHas('users');
    }

    public function test_non_admin_cannot_access_admin_page(): void
    {
        $user = User::factory()->create();
        $user->assignRole('user');

        $response = $this->actingAs($user)->get(route('admin.users.index'));

        $response->assertForbidden();
    }

    public function test_admin_can_update_user_roles(): void
    {
        $admin = User::factory()->create();
        $admin->assignRole('admin');

        $targetUser = User::factory()->create();
        $targetUser->assignRole('user');
        $editorRole = Role::findByName('editor');

        $response = $this->actingAs($admin)->put(route('admin.users.update', $targetUser), [
            'roles' => [$editorRole->id],
        ]);

        $response->assertRedirect(route('admin.users.index'));
        $this->assertTrue($targetUser->fresh()->hasRole('editor'));
        $this->assertFalse($targetUser->fresh()->hasRole('user'));
    }

    public function test_admin_can_delete_user(): void
    {
        $admin = User::factory()->create();
        $admin->assignRole('admin');

        $targetUser = User::factory()->create();

        $response = $this->actingAs($admin)->delete(route('admin.users.destroy', $targetUser));

        $response->assertRedirect(route('admin.users.index'));
        $this->assertDatabaseMissing('users', ['id' => $targetUser->id]);
    }

    public function test_admin_cannot_delete_self(): void
    {
        $admin = User::factory()->create();
        $admin->assignRole('admin');

        $response = $this->actingAs($admin)->delete(route('admin.users.destroy', $admin));

        $response->assertRedirect();
        $this->assertDatabaseHas('users', ['id' => $admin->id]);
    }
}
