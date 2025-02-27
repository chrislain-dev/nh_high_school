<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TimeTable extends Model
{
    use HasFactory;

    protected $guarded = [];

    // Relation appartient à une classe
    public function classRoom()
    {
        return $this->belongsTo(ClassRoom::class);
    }

    // Relation appartient à un enseignant
    public function teacher()
    {
        return $this->belongsTo(Teacher::class);
    }

    // Relation appartient à une matière
    public function subject()
    {
        return $this->belongsTo(Subject::class);
    }

    // Relation appartient à une salle de classe
    public function room()
    {
        return $this->belongsTo(Building::class);
    }

    // Accesseur pour obtenir la durée du cours
    public function getDurationAttribute()
    {
        $start = \Carbon\Carbon::parse($this->start_time);
        $end = \Carbon\Carbon::parse($this->end_time);
        return $end->diffInMinutes($start);
    }
}
