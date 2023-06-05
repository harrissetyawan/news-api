<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\News>
 */
class NewsFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $imagePath = fake()->image('public/storage/images', 640, 480, null, false);
        $imageName = basename($imagePath);
        return [
            'title' => fake()->words(mt_rand(3, 5), true),
            'content' => fake()->paragraphs(mt_rand(3, 8), true),
            'img' => $imageName,
            'user_id' => 1,
            'created_at' => now(),
            'updated_at' => now()
        ];
    }
}
