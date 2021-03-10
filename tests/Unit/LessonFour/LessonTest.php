<?php

namespace Tests\Unit\LessonFour;

use App\Models\Lesson;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class LessonTest extends TestCase
{
    use RefreshDatabase;
    /**
     *
     * @test
     */
    public function it_orders_by_ordinal()
    {
        Lesson::factory()->create([
            'ordinal' => 90
        ]);
        
        Lesson::factory()->create([
            'ordinal' => 1
        ]);   
            
        Lesson::factory()->create([
            'ordinal' => 42
        ]);

        $lessons = Lesson::all();
        
        $this->assertEquals([1,42,90], $lessons->pluck('ordinal')->toArray());
        // $this->assertSame(3, $lessons->count());
        // $this->assertEquals(1, $lessons[0]->ordinal);
        // $this->assertEquals(42, $lessons[1]->ordinal);
        // $this->assertEquals(90, $lessons[2]->ordinal);
    }
}; 