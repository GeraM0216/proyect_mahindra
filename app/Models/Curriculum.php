<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Curriculum extends Model
{
    /** @use HasFactory<\Database\Factories\CurriculumFactory> */
    use HasFactory;

    protected $table = "curriculums";
    public $timestamps = false;

    public function applicant(){
        return $this->belongsTo(Applicant::class);
    }

    public function job_matches(){
        return $this->hasMany(Job_match::class);
    }

    public function predictions(){
        return $this->hasMany(Prediction::class);
    }

    public function skills(){
        return $this->hasMany(Skill::class);
    }
}
