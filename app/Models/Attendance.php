<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Log;
use Carbon\Carbon;

class Attendance extends Model
{
    use HasFactory;

    // Attributs que nous autorisons à être remplis en masse
    protected $fillable = [
        'type',
        'reason',
        'student_id',
        'period_id',
        'date',
    ];

    // Définition des constantes pour le type d'absence
    const TYPE_PRESENT = 'present';
    const TYPE_ABSENT = 'absent';
    const TYPE_LATE = 'late';

    // Relation avec l'élève (un élève peut avoir plusieurs présences)
    public function student()
    {
        return $this->belongsTo(Student::class);
    }

    // Relation avec la période (une période peut avoir plusieurs présences)
    public function period()
    {
        return $this->belongsTo(Period::class);
    }

    // Formater la date en utilisant Carbon
    public function getFormattedDateAttribute()
    {
        return Carbon::parse($this->date)->format('d/m/Y'); // Ex: 25/02/2025
    }

    // Accesseur pour la date sous forme de Carbon (pour des opérations de date si nécessaire)
    public function getDateAttribute($value)
    {
        return Carbon::parse($value); // Retourner la date en tant qu'objet Carbon
    }

    // Mutateur pour le champ `date` - convertir avant enregistrement si nécessaire
    public function setDateAttribute($value)
    {
        $this->attributes['date'] = Carbon::parse($value)->format('Y-m-d'); // Sauvegarder la date sous format standard
    }

    // Validation des types (ajout d'une validation pour s'assurer que le type est valide)
    public static function boot()
    {
        parent::boot();

        static::saving(function ($attendance) {
            $validTypes = [self::TYPE_PRESENT, self::TYPE_ABSENT, self::TYPE_LATE];

            // Validation pour s'assurer que le type est correct
            if (!in_array($attendance->type, $validTypes)) {
                Log::error('Invalid attendance type: ' . $attendance->type);
                throw new \Exception('Invalid attendance type.');
            }
        });
    }

    // Scope pour récupérer les absences d'un étudiant sur une période donnée
    public function scopeAbsencesByStudent($query, $studentId, $periodId)
    {
        return $query->where('student_id', $studentId)
                     ->where('period_id', $periodId)
                     ->where('type', self::TYPE_ABSENT);
    }

    // Scope pour récupérer les présences dans une période
    public function scopePresencesByPeriod($query, $periodId)
    {
        return $query->where('period_id', $periodId)
                     ->where('type', self::TYPE_PRESENT);
    }
}
