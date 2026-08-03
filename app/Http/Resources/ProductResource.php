<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ProductResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'title' => $this->title,
            'short_description' => $this->short_description,
            'long_description' => $this->long_description,
            'image'  => $this->when(!$this->images, $this->images[2] ?? null),
            'images' => $this->images
        ];
    }
}
