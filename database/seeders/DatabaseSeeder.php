<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Applicant;
use App\Models\Curriculum;
use App\Models\Skill;
use App\Models\Prediction;
use App\Models\Job_Match;


class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
          // Crear 10 curriculums con sus relaciones
          Curriculum::factory(10) 
          ->create() // Primero crea los curriculums
          ->each(function ($curriculum) {
              // Asociar un Applicant a cada Curriculum
              $applicant = Applicant::factory()->create([
                  'curriculum_id' => $curriculum->id 
              ]);

              // Asociar Skills a cada Curriculum
              Skill::factory(3)->create([
                  'curriculum_id' => $curriculum->id 
              ]);

              // Asociar Predictions a cada Curriculum
              Prediction::factory(2)->create([
                  'curriculum_id' => $curriculum->id 
              ]);

              // Asociar Job Matches a cada Curriculum
              Job_Match::factory(4)->create([
                  'curriculum_id' => $curriculum->id 
              ]);
          });
    }
}
