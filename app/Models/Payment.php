<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Payment extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'student_id',
        'payment_for',
        'amount',
        'transaction_type',
        'transaction_reference',
        'payment_date',
    ];

    protected $casts = [
        'payment_date' => 'datetime',
        'amount' => 'decimal:2', // Précision du montant avec 2 décimales
    ];

    /**
     * Relation avec l'élève (student)
     */
    public function student()
    {
        return $this->belongsTo(Student::class);
    }

    /**
     * Accesseur pour le montant formaté
     */
    public function getFormattedAmountAttribute()
    {
        return number_format($this->amount, 2);
    }
}
