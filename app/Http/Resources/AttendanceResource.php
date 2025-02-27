<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class AttendanceResource extends JsonResource
{
    /**
     * Transforme la ressource en tableau JSON.
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'type' => $this->type,
            'reason' => $this->reason,
            'date' => $this->date,
            'time' => $this->time,
            'student_id' => $this->student_id,
            'period_id' => $this->period_id,
            'deleted_at' => $this->deleted_at,
            'created_at' => $this->created_at->format('Y-m-d H:i:s'),
            'updated_at' => $this->updated_at->format('Y-m-d H:i:s'),
        ];
    }
}
