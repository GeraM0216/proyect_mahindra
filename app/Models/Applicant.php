<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Applicant extends Model
{
    /** @use HasFactory<\Database\Factories\ApplicantFactory> */
    use HasFactory;

    protected $table = "applicants";
    protected $primaryKey = 'id';
    protected $fillable = ['curriculum_id','name','age','city','email','phone_number'];
    public $timestaps = false;

    public function curriculum(){
           return $this->belongsTo(Curriculum::class);
    }
}
