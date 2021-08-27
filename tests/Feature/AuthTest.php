<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class AuthTest extends TestCase
{
    use WithFaker;

    public function test_auth_register_missing_params()
    {
        $response = $this->post('/api/auth/register', [
            'email' => 'meow@me.com',
            'password' => 'meiw12345',
        ]);

        $response->assertStatus(400);
    }

    public function test_auth_register_success()
    {
        $response = $this->post('/api/auth/register', [
            'name' => $this->faker->name(),
            'email' => $this->faker->email(),
            'password' => 'meow12345',
            'password_confirmation' => 'meow12345',
        ]);

        $response->assertStatus(201);
    }

    public function test_auth_login_short_password()
    {
        $password = 'meow';
        $user = User::factory(User::class)->create([
            'password' => bcrypt($password),
        ]);
        $response = $this->post('/api/auth/login', [
            'email' => $user->email,
            'password' => $password,
        ]);
        $response->assertStatus(422);
    }

    public function test_auth_login_wrong_password()
    {
        $password = 'meow123';
        $user = User::factory(User::class)->create([
            'password' => bcrypt($password),
        ]);
        $response = $this->post('/api/auth/login', [
            'email' => $user->email,
            'password' => 'cat12345',
        ]);
        $response->assertStatus(401);
    }

    public function test_auth_login_success()
    {
        $password = 'meow1234';
        $user = User::factory(User::class)->create([
            'password' => bcrypt($password),
        ]);

        $response = $this->post('/api/auth/login', [
            'email' => $user->email,
            'password' => $password,
        ]);

        $response->assertStatus(200);
    }

    public function tearDown(): void
    {
        $this->artisan('migrate:refresh');
        parent::tearDown();
    }
}
