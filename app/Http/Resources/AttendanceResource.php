<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class AttendanceResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'action' => $this->action,
            'time' => $this->time,
            'location' => [
                'id' => $this->location_id,
                'name' => $this->location_name,
            ],
            'created_at' => $this->created_at,
        ];
    }
}
