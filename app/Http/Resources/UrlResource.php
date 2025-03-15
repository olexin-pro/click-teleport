<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class UrlResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            "id" => $this->resource->id,
            "destination_url" => $this->resource->destination_url,
            "url_key" => $this->resource->url_key,
            "default_short_url" => $this->resource->default_short_url,
            "created_at" => $this->resource->created_at,
        ];
    }
}
