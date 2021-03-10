<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class VideosTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $ordinal = 1;

        DB::table('videos')->delete();
        DB::table('videos')->insert([
            ['title' => 'It\'s about confidence',
            'vimeo_id' =>  196220914,
            'ordinal' => $ordinal++,
            'lesson_id' => 1,
            'heading' => 'Confident Laravel - Course Introduction'],

            ['title' => 'PHPUnit overview',
            'vimeo_id' =>  196220914,
            'ordinal' => $ordinal++,
            'lesson_id' => 1,
            'heading' => 'Start Testing- PHPUnit overview'],

            ['title' => 'HTTP Tests',
            'vimeo_id' =>  196220914,
            'ordinal' => $ordinal++,
            'lesson_id' => 1,
            'heading' => 'Start Testing - HTTP Tests'],

            ['title' => 'Customizing the structure',
            'vimeo_id' =>  196220914,
            'ordinal' => $ordinal++,
            'lesson_id' => 1,
            'heading' => 'Start Testing - Customizing the structure'],

            ['title' => 'Laravel Dusk',
            'vimeo_id' =>  196220914,
            'ordinal' => $ordinal++,
            'lesson_id' => 1,
            'heading' => 'Start Testing - Laravel Dusk'],

            ['title' => 'Generating tests',
            'vimeo_id' =>  196220914,
            'ordinal' => $ordinal++,
            'lesson_id' => 1,
            'heading' => 'Start Testing - Generating Test'],

            ['title' => 'Where to start',
            'vimeo_id' =>  196220914,
            'ordinal' => $ordinal++,
            'lesson_id' => 1,
            'heading' => 'Start Testing - Where to start'],

            ['title' => 'Summary',
            'vimeo_id' =>  196220914,
            'ordinal' => $ordinal++,
            'lesson_id' => 1,
            'heading' => 'Start Testing - Summary'],

            ['title' => 'Writing the first test',
            'vimeo_id' =>  196220914,
            'ordinal' => $ordinal++,
            'lesson_id' => 2,
            'heading' => 'Testing Application Code - Writing the first test'],

            ['title' => 'Setting up application data',
            'vimeo_id' =>  196220914,
            'ordinal' => $ordinal++,
            'lesson_id' => 2,
            'heading' => 'Testing Application Code- Setting up application data'],

            ['title' => 'Testing multiple paths',
            'vimeo_id' =>  196220914,
            'ordinal' => $ordinal++,
            'lesson_id' => 2,
            'heading' => 'Testing Application Code - Testing multiple paths'],

            ['title' => 'Dealing with authentication',
            'vimeo_id' =>  196220914,
            'ordinal' => $ordinal++,
            'lesson_id' => 2,
            'heading' => 'Testing Application Code - Dealing with authentication'],

            ['title' => 'Interacting with the database',
            'vimeo_id' =>  196220914,
            'ordinal' => $ordinal++,
            'lesson_id' => 2,
            'heading' => 'Testing Application Code - Interacting with the database'],

            ['title' => 'Handling form validation',
            'vimeo_id' =>  196220914,
            'ordinal' => $ordinal++,
            'lesson_id' => 2,
            'heading' => 'Testing Application Code - Handling form validation'],

            ['title' => 'Summary',
            'vimeo_id' =>  196220914,
            'ordinal' => $ordinal++,
            'lesson_id' => 2,
            'heading' => 'Testing Application Code - Summary'],


            ['title' => 'Understanding test doubles',
            'vimeo_id' =>  196220914,
            'ordinal' => $ordinal++,
            'lesson_id' => 3,
            'heading' => 'Testing Integration- Understanding test doubles'],

            ['title' => 'Swapping Facades',
            'vimeo_id' =>  196220914,
            'ordinal' => $ordinal++,
            'lesson_id' => 3,
            'heading' => 'Testing Integration- Swapping Facades'],

            ['title' => 'Faking shared Facades',
            'vimeo_id' =>  196220914,
            'ordinal' => $ordinal++,
            'lesson_id' => 3,
            'heading' => 'Testing Integration- Faking shared Facades'],


            ['title' => 'Mocking your custom classes',
            'vimeo_id' =>  196220914,
            'ordinal' => $ordinal++,
            'lesson_id' => 3,
            'heading' => 'Testing Integration- Mocking your custom classes'],

            ['title' => 'Pushing code to the boundry',
            'vimeo_id' =>  196220914,
            'ordinal' => $ordinal++,
            'lesson_id' => 3,
            'heading' => 'Testing Integration- Pushing code to the boundry'],


            ['title' => 'Refactoring through tests',
            'vimeo_id' =>  196220914,
            'ordinal' => $ordinal++,
            'lesson_id' => 3,
            'heading' => 'Testing Integration- Refactoring through tests'],

            ['title' => 'Using real integration test',
            'vimeo_id' =>  196220914,
            'ordinal' => $ordinal++,
            'lesson_id' => 3,
            'heading' => 'Testing Integration- Using real integration test'],


            ['title' => 'Summay',
            'vimeo_id' =>  196220914,
            'ordinal' => $ordinal++,
            'lesson_id' => 3,
            'heading' => 'Testing Integration- Summary'],

            ['title' => 'Unit testing validation',
            'vimeo_id' =>  196220914,
            'ordinal' => $ordinal++,
            'lesson_id' => 4,
            'heading' => 'Testing Additional Classes- Unit testing validation'],

            ['title' => 'Running a coverage report',
            'vimeo_id' =>  196220914,
            'ordinal' => $ordinal++,
            'lesson_id' => 4,
            'heading' => 'Testing Additional Classes- Running a coverage report'],

            ['title' => 'Testing console commands',
            'vimeo_id' =>  196220914,
            'ordinal' => $ordinal++,
            'lesson_id' => 4,
            'heading' => 'Testing Additional Classes- Testing console commands'],


            ['title' => 'Testing Events',
            'vimeo_id' =>  196220914,
            'ordinal' => $ordinal++,
            'lesson_id' => 4,
            'heading' => 'Testing Additional Classes- Testing Events'],

            ['title' => 'Testing Container Bindings',
            'vimeo_id' =>  196220914,
            'ordinal' => $ordinal++,
            'lesson_id' => 4,
            'heading' => 'Testing Additional Classes- Testing Container Bindings'],


            ['title' => 'Testing Models',
            'vimeo_id' =>  196220914,
            'ordinal' => $ordinal++,
            'lesson_id' => 4,
            'heading' => 'Testing Additional Classes- Testing Models'],

            ['title' => 'Testing Views',
            'vimeo_id' =>  196220914,
            'ordinal' => $ordinal++,
            'lesson_id' => 4,
            'heading' => 'Testing Additional Classes- Testing Views'],

            ['title' => 'Summary',
            'vimeo_id' =>  196220914,
            'ordinal' => $ordinal++,
            'lesson_id' => 4,
            'heading' => 'Testing Additional Classes- Summary'],

            ['title' => 'Keep Testing',
            'vimeo_id' =>  196220914,
            'ordinal' => $ordinal++,
            'lesson_id' => 4,
            'heading' => 'Confident laravel - Course Afterward'],

            ['title' => 'Video 1',
            'vimeo_id' =>  196220914,
            'ordinal' => $ordinal++,
            'lesson_id' => 5,
            'heading' => 'Bonus Video- Video 1'],

            ['title' => 'August 27,2019',
            'vimeo_id' =>  196220914,
            'ordinal' => $ordinal++,
            'lesson_id' => 6,
            'heading' => 'Group Q&A Calls- August 27, 2019'],


         ]);

    }
}
