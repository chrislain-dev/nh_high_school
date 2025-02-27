<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SchoolAddress extends Model
{
    use HasFactory;

    protected $guarded = [];

    /**
     * Relation avec SchoolSetting (une adresse appartient à une seule école).
     */
    public function schoolSetting()
    {
        return $this->belongsTo(SchoolSetting::class);
    }
}
