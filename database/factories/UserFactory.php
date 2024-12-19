<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class UserFactory extends Factory
{
    protected $model = User::class;

    public function definition(): array
    {
        return [
            'first_name' => $this->faker->firstName,
            'last_name' => $this->faker->lastName,
            'username' => $this->faker->unique()->userName,
            'email' => $this->faker->unique()->safeEmail,
            'password' => bcrypt('87654321'),
            'role' => 'student',
            'image' => $this->faker->imageUrl(),
            'language' => $this->faker->randomElement(['en', 'es', 'fr']),
            'description' => $this->faker->paragraph,
            'website' => $this->faker->url,
            'linkedin' => $this->faker->url,
        ];
    }
}
