<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Period extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'name',
        'slug',
        'description',
        'type',
        'start_date',
        'end_date',
        'is_current',
    ];

    /**
     * Accesseur pour vérifier si la période est en cours
     */
    public function getIsCurrentAttribute($value)
    {
        return $value ? 'Yes' : 'No';
    }

    /**
     * Méthode pour vérifier si une période est en cours
     */
    public static function getCurrentPeriod()
    {
        return self::where('is_current', true)->first();
    }

    /**
     * Méthode pour récupérer les périodes en cours (en fonction de la date actuelle)
     */
    public static function getActivePeriods()
    {
        return self::whereDate('start_date', '<=', now())
                    ->whereDate('end_date', '>=', now())
                    ->get();
    }
}
