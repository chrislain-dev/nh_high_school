<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SchoolEmail extends Model
{
    use HasFactory;

    protected $guarded = [];

    /**
     * Relation avec SchoolSetting (une école peut avoir plusieurs emails).
     */
    public function schoolSetting()
    {
        return $this->belongsTo(SchoolSetting::class);
    }
}
