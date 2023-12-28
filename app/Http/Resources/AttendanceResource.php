<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class AttendanceResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        $clockIn = $this->clock_in;
        $clockOut = $this->clock_out;
        $totalHours = $clockOut->diffInHours($clockIn);
        return [
            'id' => $this->id,
            'date' => $this->date,
            'clock_in' => $clockIn,
            'clock_out' => $clockOut,
            'total_hours' => $totalHours,
            'user' => new UserResource($this->whenLoaded('user')),
        ];
    }
}
