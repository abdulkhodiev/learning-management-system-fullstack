<?php

namespace Database\Factories;

use App\Models\CourseChapter;
use App\Models\Lesson;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Lesson>
 */
class LessonFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */

    protected $model = Lesson::class;
    public function definition(): array
    {
        return [
            'name' => $this->faker->word,
            'duration' => $this->faker->time(),
            'video_url' => $this->faker->url,
            'course_chapter_id' => CourseChapter::factory(),
            'priority' => $this->faker->word,
        ];
    }
}
