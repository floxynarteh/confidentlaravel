<?php

namespace Tests\Feature\LessonTwo\Http\Controllers;

use App\Models\User;
use App\Models\Video;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class DashboardControllerTest extends TestCase
{
    use HasFactory;
    use RefreshDatabase;

   

     /**
     *
     *@test 
     */
    public function it_defaults_last_video_for_a_new_user()
    {
        
        $video = Video::factory()->create();
        

        $user = User::factory()->create();
        
         

        $response = $this->actingAs($user)->get('/dashboard');



        $response->assertStatus(200);
        $response->assertViewIs('videos.show');
        $response->assertViewHas('now_playing', $video);
    }

     

    


    /**
     *
     * @test
     */
    public function it_retreives_the_last_watched_video()
    {


        $video = Video::factory()->create();
        


        $user = User::factory()->create([
            'last_viewed_video_id' => $video->id
        ]);
      
       

        $response = $this->actingAs($user)->get('/dashboard');
        

        $response->assertStatus(200);
        $response->assertViewIs('videos.show');
        $response->assertViewHas('now_playing', $video);

    

    }
    


}
