<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ClassFee extends Model
{
    use HasFactory;

    protected $fillable = [
        'class_room_id',
        'register_fees',
        'school_fees',
        'canteen_fees',
        'bus_fees',
        'other_fees',
        'note',
    ];

    protected $casts = [
        'register_fees' => 'decimal:2',
        'school_fees' => 'decimal:2',
        'canteen_fees' => 'decimal:2',
        'bus_fees' => 'decimal:2',
        'other_fees' => 'decimal:2',
    ];

    /**
     * Relation avec la classe (class_room).
     */
    public function classRoom()
    {
        return $this->belongsTo(ClassRoom::class);
    }

    /**
     * Accesseur pour obtenir les frais de manière formatée.
     */
    public function getRegisterFeesFormattedAttribute()
    {
        return number_format($this->register_fees, 2);
    }

    public function getSchoolFeesFormattedAttribute()
    {
        return number_format($this->school_fees, 2);
    }

    public function getCanteenFeesFormattedAttribute()
    {
        return number_format($this->canteen_fees, 2);
    }

    public function getBusFeesFormattedAttribute()
    {
        return number_format($this->bus_fees, 2);
    }

    public function getOtherFeesFormattedAttribute()
    {
        return number_format($this->other_fees, 2);
    }
}
