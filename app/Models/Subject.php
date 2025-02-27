<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Subject extends Model
{
    use HasFactory;

    protected $guarded = [];

    // Relation plusieurs-à-plusieurs avec les enseignants via la table pivot `teacher_subjects`
    public function teachers()
    {
        return $this->belongsToMany(Teacher::class, 'teacher_subjects');
    }

    // Accessor pour obtenir un nom plus lisible de la matière
    public function getFormattedNameAttribute()
    {
        return ucfirst(strtolower($this->name));
    }

    // Relation avec les notes
    public function notes()
    {
        return $this->hasMany(Note::class);
    }
}
