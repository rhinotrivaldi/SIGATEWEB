<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class LogResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'owner' => $this->user->name,
            'number_plate' => $this->vehicle->number_plate,
            'in_date' => $this->in_date,
            'out_date' => $this->out_date,
        ];
    }
}
