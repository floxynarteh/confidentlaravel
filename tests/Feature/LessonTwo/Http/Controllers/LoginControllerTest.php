<?php

namespace Tests\Feature\Http\Controllers;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithoutMiddleware;

class LoginControllerTest extends TestCase
{
    // use WithoutMiddleware;
    use RefreshDatabase;
    /**
     *
     * @test
     */
    public function login_redirect_to_dashboard()
    {
        $user = User::factory()->create();
        $response = $this->post('/login',[
            'email' => $user->email,
            'password' => 'password',
        ]);

        $response->assertRedirect('/dashboard');
        //authenticates the user created from the factory
        $this->assertAuthenticatedAs($user);
    }
}
