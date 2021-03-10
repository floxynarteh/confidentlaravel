<?php

namespace Tests\Unit\LessonFour\Http\Requests;

use App\Http\Requests\UserUpdateRequest;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class UserUpdateRequestTest extends TestCase
{ 
    use RefreshDatabase;

    private $subject;

    protected function setUp(): void
    {
        parent::setUp();

        $this->subject = new UserUpdateRequest();
    }


    /**
     *
     * @test
     */
    public function authorize_returns_false_when_unauthorized()
    {

       
        $this->assertFalse($this->subject->authorize());
    }


     /**
     *
     * @test
     */
    public function authorize_returns_true_when_unauthorized()
    {
        $user = User::factory()->make();

        $this->actingAs($user);

       
        $this->assertTrue($this->subject->authorize());
    }

    /**
     *
     * @test
     */
    public function rules()
    {

        $subject = new UserUpdateRequest();

        $this->assertSame([
            'name' => 'required|max:255',
            'password' => 'required|min:6|confirmed'

        ], $this->subject->rules());
    }


}
