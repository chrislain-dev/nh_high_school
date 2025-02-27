<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ExamType extends Model
{
    use HasFactory;

    // Relation avec les notes (un type d'examen peut avoir plusieurs notes)
    public function notes()
    {
        return $this->hasMany(Note::class);
    }

    // Relation avec les matières (facultatif si vous gérez cela)
    public function subjects()
    {
        return $this->hasMany(Subject::class);
    }
}
