<?php

namespace Tests\Feature;

use Tests\TestCase;

class TodoTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_todos()
    {
        // $user = \App\Models\User::factory(App\User::class)->create();
        // $user = $this->post('/api/auth/login', ['email' => 'nash@me.com', 'password' => '123456']);
        // $user_id = $user["user"]["id"];

        // // dd($user_id);
        // $todo = \App\Models\Todo::factory(App\Todo::class)->create(['user_id' => $user_id]);

        // $token = "Bearer $user->json()->access_token";

        // $this->get('/api/todos', ['Authorization' => $token])->assertSee($todo->todo);

        // $this->post('/api/todos', ['Authorization' => $token])->assetrStatus(201);

        $response = $this->get('/');

        $response->assertStatus(200);

    }
}
