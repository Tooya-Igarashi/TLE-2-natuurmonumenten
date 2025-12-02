<?php
namespace Database\Factories;

use App\Models\Challenge;
use App\Models\Difficulty;
use App\Models\Badge;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class ChallengeFactory extends Factory
{
    protected $model = Challenge::class;

    public function definition():array
    {
        return [
            'title' => $this->faker->sentence(3),
            'description' => $this->faker->paragraph,
            'difficulty_id' => Difficulty::factory(),
            'user_id' => User::factory(),
            'badge_id' => $this->faker->boolean(30) ? Badge::factory() : null,
            'published' => $this->faker->boolean(40),
            'duration' => $this->faker->optional()->time('H:i:s'),
        ];
    }
}
