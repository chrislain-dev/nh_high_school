<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Teacher extends Model
{
    use HasFactory;

        // Relation avec l'utilisateur (si un enseignant est aussi un utilisateur)
        public function user()
        {
            return $this->belongsTo(User::class);
        }

        // Relation avec les blâmes qu'il attribue
        public function blames()
        {
            return $this->hasMany(Blame::class);
        }

        // Relation avec les matières
        public function subjects()
        {
            return $this->belongsToMany(Subject::class, 'teacher_subjects');
        }
}
