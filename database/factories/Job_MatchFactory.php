<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Job_Match;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Job_match>
 */
class Job_MatchFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    protected $model = Job_match::class;
    public function definition(): array
    {
        return [
            'percentage' => $this->faker->numberBetween(0, 100), //
        ];
    }
}
