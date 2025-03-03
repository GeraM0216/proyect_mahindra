<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Curriculum;
use App\Models\Skill;
/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Skill>
 */
class SkillFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    protected $model = Skill::class;
    public function definition(): array
    {
        return [
            'skill_name' => $this->faker->word(), 
            'level' => $this->faker->randomElement(['Beginner', 'Intermediate', 'Advanced']), 
        ];
    }
}
