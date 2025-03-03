<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Prediction extends Model
{
    /** @use HasFactory<\Database\Factories\PredictionFactory> */
    use HasFactory;

    protected $table = "predictions";
    protected $primaryKey = 'id';
    protected $fillable = ['curriculum_id','predictions'];

    public $timestamps = false;

    public function curriculum(){
        return $this->belongsTo(Curriculum::class);
    }

    public function user(){
        return $this->belongsTo(User::class);
    }
}
