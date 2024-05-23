<?php

namespace App\Http\Resources\V1\Silder;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class SilderResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [

            'url' => $this->url,
            'image' => $this->image,



        ];
    }
}
