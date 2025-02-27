<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Note extends Model
{
    use HasFactory;

    protected $guarded = [];

    // Relation avec l'élève
    public function student()
    {
        return $this->belongsTo(Student::class);
    }

    // Relation avec le type d'examen
    public function examType()
    {
        return $this->belongsTo(ExamType::class);
    }

    // Accessor pour formater le score
    public function getScoreFormattedAttribute()
    {
        return number_format($this->score, 2);
    }
}
