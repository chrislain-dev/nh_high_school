<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Club extends Model
{
    use HasFactory;

    protected $guarded = [];

    // Relation avec les étudiants (un club a plusieurs étudiants)
    public function students()
    {
        return $this->belongsToMany(Student::class);
    }
}
