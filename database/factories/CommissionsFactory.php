<?php

namespace Database\Factories;

use App\Models\Course;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;


class CommissionsFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            "id" => $this->faker->numberBetween(1, 1000),
            'course_id' => Course::factory(),
            'user_id' => User::factory(),
            'status'=> $this->faker->word(),
            'commission' => $this->faker->randomFloat(2, 10, 1000),
        ];
    }
}
