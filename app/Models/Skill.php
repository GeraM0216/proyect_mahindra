<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Skill extends Model
{
    /** @use HasFactory<\Database\Factories\SkillFactory> */
    use HasFactory;

    protected $table = "skills";
    public $timestamps = false;

    public function curriculum(){
        return $this->belongsTo(Curriculum::class);
    }
}
