<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Job_match extends Model
{
    /** @use HasFactory<\Database\Factories\JobMatchFactory> */
    use HasFactory;

    protected $table = "job_matches";
    public $timestamps = false;

    public function curriculum(){
        return $this->belongsTo(Curriculum::class);
    }
}
