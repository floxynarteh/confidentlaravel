<?php

namespace Tests\Unit\Provider;

use App\Models\Order;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Mockery;
use Illuminate\Foundation\Testing\WithFaker;
use Spatie\Newsletter\Newsletter;
use Tests\TestCase;

class EventServiceProviderTest extends TestCase
{

    use  WithFaker,RefreshDatabase;
    /**
     * 
     * @test
     */
    public function order_placed_event_subscribes_user_and_tags_package()
    {
        $order = Order::factory()->create();

        $newsletter = Mockery::mock();

        $newsletter->shouldReceive('subscribe')
                   ->with($order->user->email);

        $newsletter->shouldReceive('addTags')
                  ->with([$order->product->name], $order->user->email);

        \Newsletter::swap($newsletter);          
                   
        event('order.placed', $order);
        // $this->assertTrue(true);
    }
 

     /**
     * 
     * @test
     */
    public function video_watched_tags_subscriber_with_video()
    {

        $newsletter = Mockery::mock();

        $video_id = $this->faker->randomDigitNotNull;
        $user = User::factory()->create();

        $newsletter->shouldReceive('addTags')
                   ->with(['Video-'. $video_id], $user->email);


        

        \Newsletter::swap($newsletter);   
        
        
        event('video.watched', [$user,$video_id]);
    }

}

  

    