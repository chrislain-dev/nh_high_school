<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Carbon\Carbon;

class BusDriver extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'type',
        'status',
        'gender',
        'first_name',
        'last_name',
        'slug',
        'email',
        'phone',
        'address',
        'dob',
        'profile_image_url',
        'cni',
        'salary',
        'nationality_id',
        'birth_place_id',
    ];

    protected $casts = [
        'dob' => 'date',  // Utilisation de l'objet Carbon pour les dates
    ];

    protected $dates = [
        'deleted_at', // Utilisation de softDeletes
        'dob',  // S'assurer que dob est une instance de Carbon
    ];

    /**
     * Relation avec le modèle Country (nationalité)
     */
    public function nationality()
    {
        return $this->belongsTo(Country::class, 'nationality_id');
    }

    /**
     * Relation avec le modèle Country (lieu de naissance)
     */
    public function placeOfBirth()
    {
        return $this->belongsTo(Country::class, 'place_of_birth_id');
    }

    /**
     * Formatage de la date de naissance (dob) sous forme d'une date lisible
     */
    public function getDobFormattedAttribute()
    {
        return Carbon::parse($this->dob)->format('d/m/Y');
    }

    /**
     * Scope pour récupérer les chauffeurs actifs
     */
    public function scopeActive($query)
    {
        return $query->where('status', 'active');
    }

    /**
     * Scope pour récupérer les chauffeurs inactifs
     */
    public function scopeInactive($query)
    {
        return $query->where('status', 'inactive');
    }

    /**
     * Mutateur pour la date de naissance (formatage automatique avant insertion)
     */
    public function setDobAttribute($value)
    {
        $this->attributes['dob'] = Carbon::parse($value)->format('Y-m-d');
    }
}
