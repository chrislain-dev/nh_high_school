<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class SchoolSetting extends Model
{
    use HasFactory, SoftDeletes;

    protected $guarded = [];

    /**
     * Relation avec SchoolAddress (une école peut avoir plusieurs adresses).
     */
    public function schoolAddresses()
    {
        return $this->hasMany(SchoolAddress::class);
    }

    public function schoolEmails()
    {
        return $this->hasMany(SchoolEmail::class);
    }
    
    public function schoolImages()
    {
        return $this->hasMany(SchoolImage::class);
    }

    public function schoolPhones()
    {
        return $this->hasMany(SchoolPhone::class);
    }
}
