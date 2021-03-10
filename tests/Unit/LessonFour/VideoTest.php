<?php

namespace Tests\Unit\LessonFour;

use App\Models\Video;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class VideoTest extends TestCase
{
    use RefreshDatabase;
    /**
     *
     * @test
     * @dataProvider  hasDownloadDataProvider
     */
    public function hasDownload($id, $expected)
    {

        $video = Video::factory()->make();

        $video->id =$id;

        $this->assertSame($expected, $video->hasDownload());
 
        
        //$video->id =null;

        // $this->assertFalse($video->hasDownload());

        
        // $video->id = 1;

        // $this->assertFalse($video->hasDownload());

        // $video->id = 8;

        // $this->assertTrue($video->hasDownload());

        // $video->id = 9;

        // $this->assertTrue($video->hasDownload());
    }


    /**
     * @test
     */
    public function it_orders_by_ordinal(){

        Video::factory()->create([
            'ordinal' => 90,
        ]);

        Video::factory()->create([
            'ordinal' => 1,
        ]);

        Video::factory()->create([
            'ordinal' => 42,
        ]);

        $videos = Video::all();

        

        $this->assertEquals([1,42,90], $videos->pluck('ordinal')->toArray());

        // $this->assertSame(3, $videos->count());
        // $this->assertEquals(1, $videos[0]->ordinal);
        // $this->assertEquals(42, $videos[1]->ordinal);
        // $this->assertEquals(90, $videos[2]->ordinal);
        
    }

 // helps to test methods that receive different parameters
    public function hasDownloadDataProvider(){
        return[
            [null, false],
            [0, false],
            [8, true],
            [9, true],


        ];
    }
};
