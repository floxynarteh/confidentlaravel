<?php

namespace Tests\Feature\LessonTwo\Http\Controllers;
use App\Models;
use App\Models\Lesson;
use App\Models\User;
use App\Models\Video;
use App\Models\Product;
use App\Models\Order;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class VideoControllerTest extends TestCase
{

    use HasFactory;
    use  RefreshDatabase;

    /**
     *
     *
     * @test
     */
    public function show_sets_last_video_and_display_view()
    {


        $user = User::factory()->create();
        $video = Video::factory()->create();
        $response = $this->actingAs($user)->get(route('videos.show', $video->id));

        $response->assertStatus(200);
        $response->assertViewIs('videos.show');
        $response->assertViewHas('now_playing', $video);


        $user->refresh();
        $this->assertEquals($video->id, $user->last_viewed_video_id);

    }

    /**
     *
     *
     * @test
     */
    public function show_returns_403_when_user_does_not_have_access()
    {

        
        $user = User::factory()->create();

        
        $lesson = Lesson::factory()->create([
            'product_id' => Product::FULL
        ]);

        $video = Video::factory()->create([
            'lesson_id' => $lesson->id
        ]);

        $order = Order::factory()->create([
            'user_id' => $user->id,
            'product_id' => Product::STARTER
        ]);

        $response = $this->actingAs($user)->get(route('videos.show', $video->id));

        $response->assertForbidden();
      
    }
}
