<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class UserControllerFeatureTest extends TestCase
{
    use WithFaker;

    // index
    public function test_it_can_display_the_users_list_page()
    {
        $user = User::factory()->create();

        $this->actingAs($user)
            ->get(route('users.index'))
            ->assertStatus(200)
            ->assertSee('List of Users');
    }

    public function test_it_throws_authorization_error_when_displaying_the_users_list_page()
    {
        $user = User::factory()->create(['role' => 0]);

        $this->actingAs($user)
            ->get(route('users.index'))
            ->assertStatus(403);
    }

    public function test_it_redirects_to_login_page_when_displaying_the_users_list_page_while_user_still_logged_out()
    {
        $this->get(route('users.index'))
            ->assertStatus(302)
            ->assertRedirect(route('login.index'));
    }

    // create
    public function test_it_can_display_the_create_user_page()
    {
        $user = User::factory()->create();

        $this->actingAs($user)
            ->get(route('users.create'))
            ->assertStatus(200)
            ->assertSee('Create User');
    }

    public function test_it_throws_authorization_error_when_displaying_the_create_user_page()
    {
        $user = User::factory()->create(['role' => 0]);

        $this->actingAs($user)
            ->get(route('users.create'))
            ->assertStatus(403);
    }

    public function test_it_redirects_to_login_page_when_displaying_the_create_user_page_while_user_still_logged_out()
    {
        $this->get(route('users.create'))
            ->assertStatus(302)
            ->assertRedirect(route('login.index'));
    }

    // User Data
    protected function userData()
    {
        return [
            'username' => $this->faker->unique()->isbn10,
            'first_name' => $this->faker->firstName('male'),
            'last_name' => $this->faker->lastName,
            'password' => config('global.default_password'),
            'password_confirmation' => config('global.default_password'),
            'role' => 1,
        ];
    }
    
    // store
    public function test_it_can_create_the_user()
    {
        $user = User::factory()->create();

        $this->actingAs($user)
            ->post(route('users.store'), $this->userData())
            ->assertStatus(302)
            ->assertRedirect(route('users.create'))
            ->assertSessionHas(['message' => 'User was successfully created.']);
    }

    public function test_it_throws_validation_error_when_creating_the_user()
    {
        $user = User::factory()->create();

        $this->actingAs($user)
            ->post(route('users.store'), [])
            ->assertSessionHas(['errors']);
    }

    public function test_it_throws_authorization_error_when_creating_the_user()
    {
        $user = User::factory()->create(['role' => 0]);

        $this->actingAs($user)
            ->post(route('users.store'), $this->userData())
            ->assertStatus(403);
    }

    public function test_it_redirects_to_login_page_when_creating_the_user_while_user_still_logged_out()
    {
        $this->post(route('users.store'), $this->userData())
            ->assertStatus(302)
            ->assertRedirect(route('login.index'));
    }

    // edit
    public function test_it_can_display_the_edit_user_page()
    {
        $user = User::factory()->create();

        $this->actingAs($user)
            ->get(route('users.edit', ['user' => $user->id]))
            ->assertStatus(200)
            ->assertSee('Edit User');
    }

    public function test_it_throws_authorization_error_when_displaying_the_edit_user_page()
    {
        $user = User::factory()->create(['role' => 0]);

        $this->actingAs($user)
            ->get(route('users.edit', ['user' => $user->id]))
            ->assertStatus(403);
    }

    public function test_it_throws_model_not_found_error_when_displaying_the_edit_user_page()
    {
        $user = User::factory()->create();

        $this->actingAs($user)
            ->get(route('users.edit', ['user' => $this->faker->randomNumber(9)]))
            ->assertStatus(404);
    }

    public function test_it_redirects_to_login_page_when_displaying_the_edit_user_page_while_user_still_logged_out()
    {
        $user = User::factory()->create();

        $this->get(route('users.edit', ['user' => $user->id]))
            ->assertStatus(302)
            ->assertRedirect(route('login.index'));
    }

    // update
    public function test_it_can_update_the_user()
    {
        $user = User::factory()->create();

        $this->actingAs($user)
            ->put(route('users.update', ['user' => $user->id]), $this->userData())
            ->assertStatus(302)
            ->assertRedirect(route('users.edit', ['user' => $user->id]))
            ->assertSessionHas(['message' => 'User was successfully updated.']);
    }

    public function test_it_throws_validation_error_when_updating_the_user()
    {
        $user = User::factory()->create();

        $this->actingAs($user)
            ->put(route('users.update', ['user' => $user->id]), [])
            ->assertSessionHas(['errors']);
    }

    public function test_it_throws_authorization_error_when_updating_the_user()
    {
        $user = User::factory()->create(['role' => 0]);

        $this->actingAs($user)
            ->put(route('users.update', ['user' => $user->id]), $this->userData())
            ->assertStatus(403);
    }

    public function test_it_throws_model_not_found_error_when_updating_the_user()
    {
        $user = User::factory()->create();

        $this->actingAs($user)
            ->put(route('users.update', ['user' => $this->faker->randomNumber(9)]), $this->userData())
            ->assertStatus(404);
    }

    public function test_it_redirects_to_login_page_when_updating_the_user_while_user_still_logged_out()
    {
        $user = User::factory()->create();

        $this->put(route('users.update', ['user' => $user->id]), $this->userData())
            ->assertStatus(302)
            ->assertRedirect(route('login.index'));
    }

    // destroy
    public function test_it_can_delete_the_user()
    {
        $authUser = User::factory()->create();
        $dummyUser = User::factory()->create();

        $this->actingAs($authUser)
            ->delete(route('users.destroy', ['user' => $dummyUser->id]))
            ->assertStatus(302)
            ->assertRedirect(route('users.index'))
            ->assertSessionHas(['message' => 'User was successfully deleted.']);
    }

    public function test_it_throws_authorization_error_when_deleting_the_user()
    {
        $authUser = User::factory()->create(['role' => 0]);
        $dummyUser = User::factory()->create();

        $this->actingAs($authUser)
            ->delete(route('users.destroy', ['user' => $dummyUser->id]))
            ->assertStatus(403);
    }

    public function test_it_throws_model_not_found_error_when_deleting_the_user()
    {
        $user = User::factory()->create();

        $this->actingAs($user)
            ->delete(route('users.destroy', ['user' => $this->faker->randomNumber(9)]))
            ->assertStatus(404);
    }

    public function test_it_redirects_to_login_page_when_deleting_the_user_while_user_still_logged_out()
    {
        $user = User::factory()->create();

        $this->delete(route('users.destroy', ['user' => $user->id]))
            ->assertStatus(302)
            ->assertRedirect(route('login.index'));
    }
}
