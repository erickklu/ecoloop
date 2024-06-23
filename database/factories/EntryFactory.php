<?php

namespace Database\Factories;

use App\Models\Entry;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Entry>
 */
class EntryFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'title'=> fake()->title(),
            'description'=>fake()->paragraph(),
            'category_id' => 1,
            /* 'image' => fake()->imageUrl($width = 640, $height = 480), */
            'image' => 'entries\June2024\J8JOCJedvMAkUFlEiez1.jpg',
            'user_id' => 1,
            'state' => 'DISPONIBLE'
        ];
    }
}
