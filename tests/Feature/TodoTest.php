<?php

namespace Tests\Feature;

// use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use \App\Models\Todo;
use \App\Models\User;

class TodoTest extends TestCase
{
    use WithFaker;
    // use DatabaseTransactions;
    /**
     * A basic feature test example.
     *
     * @return void
     */

    private $user;
    private $token;
    private $todo;

    public function setUp(): void
    {
        parent::setUp();
        $password = 'meow1234';
        $this->user = User::factory(User::class)->create([
            'password' => bcrypt($password),
        ]);
        $login_response = $this->post('/api/auth/login', [
            'email' => $this->user->email,
            'password' => $password,
        ]);

        $this->token = $login_response->json()['access_token'];
        $this->todo = Todo::factory(Todo::class)->create(['user_id' => $this->user->id]);
    }

    public function test_get_todos_success()
    {
        $this->get('/api/todos', ['Authorization' => "Bearer $this->token"])
            ->assertSee($this->todo->todo)
            ->assertStatus(200);
    }

    public function test_post_todos_success()
    {
        $this->withHeaders(['Authorization' => 'Bearer ' . $this->token])
            ->post('/api/todos', ['todo' => 'test todo'])->assertStatus(200);
    }

    public function test_put_todos_success()
    {
        $this->withHeaders(['Authorization' => 'Bearer ' . $this->token])
            ->post('/api/todos', ['todo' => 'test todo'])->assertStatus(200);
    }

    public function tearDown(): void
    {
        $this->artisan('migrate:refresh');
        parent::tearDown();
    }

}
