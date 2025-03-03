<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Curriculum;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Curriculum>
 */
class CurriculumFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    protected $model = Curriculum::class;
    public function definition(): array
    {
        return [
            'experience' => $this->faker->text(20), 
            'projects' => $this->faker->text(20, ),  
        ];
    }
}
