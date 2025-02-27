<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Blame extends Model
{
    use HasFactory;

    // Protéger les champs à remplir en masse
    protected $guarded = [];

    // Définir des constantes pour les types de blâmes (facultatif)
    const TYPE_MINOR = 'minor';
    const TYPE_MAJOR = 'major';
    const TYPE_SERIOUS = 'serious';

    // Relation avec l'élève
    public function student()
    {
        return $this->belongsTo(Student::class);
    }

    // Relation avec l'enseignant qui a donné le blâme
    public function teacher()
    {
        return $this->belongsTo(Teacher::class);
    }

    // Formater la date donnée du blâme
    public function getFormattedDateGivenAttribute()
    {
        return Carbon::parse($this->date_given)->format('d/m/Y'); // Format: 25/02/2025
    }

    // Accesseur pour la date donnée sous forme de Carbon
    public function getDateGivenAttribute($value)
    {
        return Carbon::parse($value); // Retourner un objet Carbon pour la manipulation
    }

    // Mutateur pour la date donnée (s'assurer qu'elle est enregistrée dans le bon format)
    public function setDateGivenAttribute($value)
    {
        $this->attributes['date_given'] = Carbon::parse($value)->format('Y-m-d');
    }

    // Scope pour récupérer les blâmes d'un élève
    public function scopeByStudent($query, $studentId)
    {
        return $query->where('student_id', $studentId);
    }

    // Scope pour récupérer les blâmes d'un enseignant
    public function scopeByTeacher($query, $teacherId)
    {
        return $query->where('teacher_id', $teacherId);
    }

    // Scope pour récupérer les blâmes par type (mineur, majeur)
    public function scopeByType($query, $type)
    {
        return $query->where('type', $type);
    }
}
