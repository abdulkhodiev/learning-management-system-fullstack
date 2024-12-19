<?php

namespace Database\Factories;

use App\Models\Course;
use App\Models\Category;
use App\Models\Mentor;
use Illuminate\Database\Eloquent\Factories\Factory;

class CourseFactory extends Factory
{
    protected $model = Course::class;

    public function definition(): array
    {
        return [
            'title' => $this->faker->sentence,
            'description' => $this->faker->paragraph,
            'price' => $this->faker->randomFloat(2, 10, 1000),
            'languages' => $this->faker->words(3, true),
            'category_id' => Category::factory(), // Create or use existing category
            'mentor_id' => Mentor::factory(), // Assuming the mentor is a user
            'image' => $this->faker->imageUrl(),
        ];
    }
}
