<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Http\Resources\Json\ResourceCollection;

class VehicleResource extends JsonResource
{
    /**
     * Transform the resource collection into an array.
     *
     * @return array<int|string, mixed>
     */
    public function toArray($request)
    {
        return [
            'id' => $this->vehicle->id,
            'vehicle_name' => $this->vehicle->vehicle_name,
            'number_plate' => $this->vehicle->number_plate,
            'picture' => $this->vehicle->picture,
            'status' => $this->vehicle->status,
            'period_date' => $this->vehicle->period_date,
            'active_hour' => $this->vehicle->active_hour,
        ];
    }
}
