<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class StadiumResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'name' => $this->name,
            'address' => $this->address,
            'phone' => $this->phone,
            'description' => $this->description,
            'images' => $this->images,
            'open_at' => $this->open_at,
            'closed_at' => $this->closed_at,
        ];
    }
}
