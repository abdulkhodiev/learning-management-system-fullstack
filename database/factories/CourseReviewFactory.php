<?php

namespace Database\Factories;

use App\Models\Course;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class CourseReviewFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            "user_id"=> User::factory(),
            "course_id" => Course::factory(),
            "comment" => $this->faker->text,
            "rate" => $this->faker->numberBetween(1, 5)
        ];
    }
}
