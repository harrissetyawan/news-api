<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\DB;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Comments>
 */
class CommentsFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'user_id' => mt_rand(2, 10),
            'news_id' => mt_rand(1, 14),
            'comment' => fake()->sentences(mt_rand(1, 4), true),
            'created_at' => now(),
            'updated_at' => now()
        ];
    }
}
