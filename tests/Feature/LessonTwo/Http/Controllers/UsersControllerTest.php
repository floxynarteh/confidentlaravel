<?php

namespace Tests\Feature\LessonTwo\Http\Controllers;

use App\Http\Controllers\UsersController;
use App\Http\Requests\UserUpdateRequest;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Hash;
use JMac\Testing\Traits\HttpTestAssertions;
use JMac\Testing\Traits\AdditionalAssertions;
use Illuminate\Foundation\Testing\TestCase as BaseTestCase;
use Laravel\Dusk\Http\Controllers\UserController;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Tests\TestCase;

class UsersControllerTest extends TestCase
{
     use WithFaker, RefreshDatabase, AdditionalAssertions;
     use WithoutMiddleware;
    /**
     *
     *
     * @test
     */
    public function update_saves_data_and_redirects_to_dashboard()
    {

        // $this->withoutExceptionHandling();

        $user = User::factory()->create();

        $name = $this->faker->name;
        $password = $this->faker->md5;

        $response = $this->actingAs($user)->put('/users',[
            'name' => $name,
            'password' => $password,
            'password_confirmation' => $password,
        ]);

        $response->assertRedirect('/dashboard');

        $user->refresh();
        $this->assertEquals($name, $user->name);
        $this->assertTrue(Hash::check($password, $user->password));
    }


     /**
     * @test
     */
    public function update_uses_validation(){
        $this->assertActionUsesFormRequest(

            UsersController::class,
            'update',
            UserUpdateRequest::class

        );
    }

    // /**
    //  * @test
    //  */

    // public function update_fails_for_invalid_name(){


    //     $user = User::factory()->create();


    //     $password = $this->faker->password(8);

    //     $response = $this->from(route('user.edit'))
    //          ->actingAs($user)
    //          ->put('/users',[
    //         'name' => null,
    //         'password' => $password,
    //         'password_confirmation' => $password,
    //     ]);

    //     $response->assertRedirect(route('user.edit'));
    //     $response->assertSessionHasErrors('name');
    // }

    // /**
    //  * @test
    //  */

    // public function update_fails_for_invalid_password(){


    //     $user = User::factory()->create();


    //     $response = $this->from(route('user.edit'))
    //          ->actingAs($user)
    //          ->put('/users',[
    //         'name' => $this->faker->name,
    //         'password' => null,
    //         'password_confirmation' => null,
    //     ]);

    //     $response->assertRedirect(route('user.edit'));
    //     $response->assertSessionHasErrors('password');
    // }

   

    
}
