<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Bus extends Model
{
    use HasFactory;

    protected $guarded = [];

    // Relation avec les élèves (un bus peut transporter plusieurs élèves)
    public function students()
    {
        return $this->hasMany(Student::class);
    }
}
