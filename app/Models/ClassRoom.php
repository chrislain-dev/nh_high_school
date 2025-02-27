<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ClassRoom extends Model
{
    use HasFactory;

    protected $guarded = [];

    // Relation avec les étudiants (une classe a plusieurs élèves)
    public function students()
    {
        return $this->hasMany(Student::class);
    }

    // Relation avec les enseignants
    public function teachers()
    {
        return $this->hasMany(Teacher::class);
    }

    // Relation avec le niveau de la classe
    public function classLevel()
    {
        return $this->belongsTo(ClassLevel::class);
    }

    // Relation avec les emplois du temps
    public function timeTables()
    {
        return $this->hasMany(TimeTable::class);
    }
}
