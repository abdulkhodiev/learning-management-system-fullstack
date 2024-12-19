<?php

namespace Database\Factories;

use App\Models\Mentor;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Mentor>
 */
class MentorFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */

     protected $model = Mentor::class;

    public function definition(): array
    {
        return [
            'user_id' => User::factory(),
            'fields' => $this->faker->text,
            'experience' => $this->faker->text
        ];
    }
}
