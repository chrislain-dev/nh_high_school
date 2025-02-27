<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ClassLevel extends Model
{
    use HasFactory;

    protected $guarded = [];

    // Relation un-à-plusieurs avec les classes
    public function classRooms()
    {
        return $this->hasMany(ClassRoom::class);
    }
}
