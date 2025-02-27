<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tutor extends Model
{
    use HasFactory;

    protected $guarded = [];

    // Relation plusieurs-à-plusieurs avec les élèves via la table pivot `student_tutors`
    public function students()
    {
        return $this->belongsToMany(Student::class, 'student_tutors');
    }

    // Accesseur pour obtenir le nom complet du tuteur
    public function getFullNameAttribute()
    {
        return $this->prenom . ' ' . $this->nom;
    }
}
