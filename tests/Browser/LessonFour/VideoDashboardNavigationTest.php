<?php

namespace Tests\Browser\LessonFour;

use App\Models\Lesson;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Laravel\Dusk\Browser;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Models\Order;
use App\Models\Product;
use App\Models\Video;
use App\Models\Watch;
use Facebook\WebDriver\WebDriverBy;
use Tests\DuskTestCase;

use function PHPUnit\Framework\assertEquals;

class VideoDashboardNavigationTest extends DuskTestCase
{
    use DatabaseMigrations;
    use HasFactory;
    /**
     *
     * @test
     */
    public function it_displays_course_navigations_correctly()
    {
        
        $this->browse(function (Browser $browser) {
            $order = Order::factory()->create();

            $freeLesson = Lesson::factory()->create([
                    'ordinal' => 1,
            ]);

            $freeVideos =Video::factory()->count(2)->create(
                [
                    'lesson_id' => $freeLesson->id
            ]);

            $packageLesson = Lesson::factory()->create([
                        'ordinal' => 2,
                        'product_id' => $order->product_id,
            ]); 


            $packageVideos =Video::factory()->count(3)->create(
                [
                    'lesson_id' => $packageLesson->id
                ])->sortBy('ordinal')->values();
            
            $paidLesson = Lesson::factory()->create(
                [
                    'ordinal' => 3,
                    'product_id' => Product::factory()->create()->id,
            ]); 

            //paid lesson
            $paidVideos =Video::factory()->count(2)->create(
                [
                    'lesson_id' => $paidLesson->id
                ]);


            $freeVideos->push($packageVideos[0])->each(function ($video) use ($order){
                 Watch::create([
                     'video_id'=> $video->id,
                     'user_id' => $order->user_id
                 ]);
            });


            $order->user->last_viewed_video_id = $packageVideos[1]->id;
            $order->user->save();


            $browser->loginAs($order->user)
                    ->visit('/dashboard')
                   ->assertSee($freeLesson->name);



            //Assertions
            //lesson
            $lessonElements = $browser->elements('nav > details');
            $this->assertCount(3, $lessonElements);
            
            $summaryElement =  $lessonElements[0]->findElement(WebDriverBy::cssSelector('summary.border-l-2.border-green-300'));
            $this>assertEquals($freeLesson->name, $summaryElement->getText());  
            $this->assertNull($lessonElements[0]->getAttribute('open'));

            $lessonElements[0]->click();
            $this->assertEquals('true', $lessonElements[0]->getAttribute('open'));
            $videoElements = $lessonElements[1]->findElements(WebDriverBy::cssSelector('div > a.border-l-2.border-green-300'));
            $this->assertCount(1, $videoElements);
            
            $summaryElement =  $lessonElements[1]->findElement(WebDriverBy::cssSelector('summary.border-l-2.border-yellow-500'));
            $this>assertEquals($packageLesson->name, $summaryElement->getText()); 
            $this->assertEquals('true', $lessonElements[1]->getAttribute('open'));

            //video assertions
            $videoElements = $lessonElements[1]->findElements(WebDriverBy::cssSelector('div > a'));
            $this->assertCount(3, $videoElements);

            $this->assertStringContainsString('border-green-300', $videoElements[0]->getAttribute('class'));
            $this->assertEquals($packageVideos[0]->title, $videoElements[0]->getText());
            $this->assertStringContainsString('border-yellow-500', $videoElements[1]->getAttribute('class'));
            $this->assertEquals($packageVideos[1]->title, $videoElements[1]->getText());
            $this->assertStringContainsString('border-gray-700', $videoElements[2]->getAttribute('class'));
            $this->assertEquals($packageVideos[2]->title, $videoElements[2]->getText());
            
            
            $summaryElement =  $lessonElements[2]->findElement(WebDriverBy::cssSelector('summary:not(.border-l-2)'));
            $this->assertStringContainsString($paidLesson->name, $summaryElement->getText());  
            $this->assertNull($lessonElements[2]->getAttribute('open'));

            $pillElement = $summaryElement->findElement(WebDriverBy::cssSelector('span.rounded-full.bg-yellow-400'));
            $this->assertEquals('upgrade', strtolower($pillElement->getText()));

            $lessonElements[2]->click();
            $this->assertEquals('true', $lessonElements[2]->getAttribute('open'));
            $videoElements = $lessonElements[2]->findElements(WebDriverBy::cssSelector('div > a'));
            $this->assertEmpty($videoElements);
            $videoElements = $lessonElements[2]->findElements(WebDriverBy::cssSelector('div > span.border-l-2.border-gray-700'));
            $this->assertCount(2, $videoElements);
        });

    }
}
