<?php

namespace Database\Factories;

use App\Models\Video;

use App\Models\Lesson;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Faker\Generator as Faker;

class VideoFactory extends Factory
{

    use HasFactory;
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Video::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'title' => $this->faker->words(3, true),
            'heading' => $this->faker->sentence,
            'summary' => $this->faker->text,
            'vimeo_id' => $this->faker->md5,
            'ordinal' => $this->faker->randomNumber(),
            'lesson_id' => function(){
               return Lesson::factory()->create()->id;

            }


        ];
    }
}
