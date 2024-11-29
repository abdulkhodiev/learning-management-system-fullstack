<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class UserFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = User::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'first_name' => $this->faker->firstName,
            'last_name' => $this->faker->lastName,
            'username' => $this->faker->unique()->userName,
            'email' => $this->faker->unique()->safeEmail,
            'password' => bcrypt('password'), // or Hash::make('password')
            'role' => 'student',  // Add default role here if needed
            'image' => $this->faker->imageUrl(),
            'language' => 'en',
            'description' => $this->faker->paragraph,
            'youtube' => $this->faker->url,
            'x' => null,
            'website' => $this->faker->url,
            'linkedin' => $this->faker->url,
        ];
    }
}
