<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Student extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'user_id', 'class_room_id', 'slug', 'profile_image_url',
        'joining_date', 'joining_class_id',
        'first_name', 'last_name', 'email', 'cni', 'matricule',
        'birthdate', 'place_of_birth_id', 'nationality_id',
        'phone_number', 'address', 'gender', 'status'
    ];

    // Relation avec la table users (un élève peut être un utilisateur)
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Relation avec la table class_rooms (une classe)
    public function classRoom()
    {
        return $this->belongsTo(ClassRoom::class);
    }

    // Relation avec les notes (un élève peut avoir plusieurs notes)
    public function notes()
    {
        return $this->hasMany(Note::class);
    }

    // Relation avec les absences (un élève peut avoir plusieurs absences)
    public function absences()
    {
        return $this->hasMany(Attendance::class);
    }

    // Relation avec les blâmes
    public function blames()
    {
        return $this->hasMany(Blame::class);
    }

    // Relation avec les clubs (un élève peut participer à plusieurs clubs)
    public function clubs()
    {
        return $this->belongsToMany(Club::class);
    }

    // Relation avec les bus (si transport disponible)
    public function bus()
    {
        return $this->belongsTo(Bus::class);
    }

    // Relation plusieurs-à-plusieurs avec les tuteurs via la table pivot `student_tutors`
    public function tutors()
    {
        return $this->belongsToMany(Tutor::class, 'student_tutors');
    }

    // Accessor pour récupérer le nom complet de l'élève
    public function getFullNameAttribute()
    {
        return $this->first_name . ' ' . $this->last_name;
    }

}
