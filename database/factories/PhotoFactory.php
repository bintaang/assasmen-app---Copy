<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Photo;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Photo>
 */
class PhotoFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'title' => $this->faker->sentence(),
            'location' => $this->faker->city(),
            'message' => $this->faker->paragraph(),
            'photo_path' => $this->faker->imageUrl(640, 480, 'nature, human', true),
            'music_path' => $this->faker->filePath('public', 'music', 'mp3'),
            'music_url' => $this->faker->url(),
        ];
    }
}
