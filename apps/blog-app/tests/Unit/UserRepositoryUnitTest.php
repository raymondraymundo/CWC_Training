<?php

namespace Tests\Unit;

use App\Models\User;
use App\Repositories\User\UserRepository;
use Illuminate\Http\Request;
use Illuminate\Contracts\Support\Jsonable;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Collection;
use Doctrine\Instantiator\Exception\InvalidArgumentException;
use Tests\TestCase;

class UserRepositoryUnitTest extends TestCase
{
    use WithFaker;

    // Get User
    public function test_it_can_get_all_the_users()
    {
        User::factory(3)->create();

        $repository = new UserRepository(new User);
        $users = $repository->get();

        $this->assertInstanceOf(Collection::class, $users);
    }

    // Paginate User
    public function test_it_can_paginate_the_users()
    {
        User::factory(3)->create();

        $repository = new UserRepository(new User);
        $users = $repository->paginate(10);

        $this->assertInstanceOf(Jsonable::class, $users);
    }

    // User Data
    protected function userRequest()
    {
        return new Request([
            'username' => $this->faker->unique()->isbn10,
            'first_name' => $this->faker->firstName('male'),
            'last_name' => $this->faker->lastName,
            'password' => config('global.default_password'),
            'role' => 1,
        ]);
    }

    // Create User
    public function test_it_can_create_the_user()
    {
        $repository = new UserRepository(new User);
        $user = $repository->create($this->userRequest());

        $this->assertInstanceOf(User::class, $user);
    }

    public function test_it_throws_error_when_creating_the_user()
    {
        $this->expectException(InvalidArgumentException::class);

        $repository = new UserRepository(new User);
        $repository->create(new Request([]));
    }

    // Find User
    public function test_it_can_find_the_user()
    {
        $user = User::factory()->create();

        $repository = new UserRepository(new User);
        $foundUser = $repository->find($user->id);

        $this->assertInstanceOf(User::class, $foundUser);
        $this->assertEquals($user->username, $foundUser->username);
    }

    public function test_it_throws_error_when_finding_the_user()
    {
        $this->expectException(ModelNotFoundException::class);

        $repository = new UserRepository(new User);
        $repository->find($this->faker->randomNumber(9));
    }

    // Update User
    public function test_it_can_update_the_user()
    {
        $user = User::factory()->create();

        $repository = new UserRepository(new User);
        $updatedUser = $repository->update($data = $this->userRequest(), $user->id);

        $this->assertInstanceOf(User::class, $updatedUser);
        $this->assertEquals($updatedUser->username, $data['username']);
    }

    public function test_it_throws_error_when_updating_the_user()
    {
        $this->expectException(InvalidArgumentException::class);

        $user = User::factory()->create();

        $repository = new UserRepository(new User);
        $repository->update(new Request([]), $user->id);
    }

    // Delete User
    public function test_it_can_delete_the_user()
    {
        $user = User::factory()->create();

        $repository = new UserRepository(new User);
        $deletedUser = $repository->delete($user->id);

        $this->assertInstanceOf(User::class, $deletedUser);
        $this->assertEquals($user->username, $deletedUser->username);
    }

    public function test_it_throws_error_when_deleting_the_user()
    {
        $this->expectException(ModelNotFoundException::class);

        $repository = new UserRepository(new User);
        $repository->delete($this->faker->randomNumber(9));
    }
}
