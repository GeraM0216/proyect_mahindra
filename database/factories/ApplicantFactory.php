<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Curriculum;
use App\Models\Applicant;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Applicant>
 */
class ApplicantFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */

     protected $model = Applicant::class;
    public function definition(): array
    {
        return [
            'curriculum_id' => Curriculum::factory(), // Genera un Curriculum aleatorio
            'name' => $this->faker->name(),
            'age' => $this->faker->numberBetween(18, 60),
            'city' => $this->faker->city(),
            'email' => $this->faker->unique()->safeEmail(),
            'phone_number' => $this->faker->phoneNumber(),//
        ];
    }
}
