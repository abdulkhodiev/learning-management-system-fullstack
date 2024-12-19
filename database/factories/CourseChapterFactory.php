<?php

namespace Database\Factories;

use App\Models\CourseChapter;
use Illuminate\Database\Eloquent\Factories\Factory;

class CourseChapterFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    protected $model = CourseChapter::class;
    public function definition(): array
    {
        return [
            'name' => $this->faker->word,
            'course_id' => CourseChapter::factory(),
        ];
    }
}
