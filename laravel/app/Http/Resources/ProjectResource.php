<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

use App\Http\Resources\DiaryResource;
use App\Http\Resources\WPResource;

class ProjectResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            "id" => $this->id,
            "name" => $this->name,
            "customer" => $this->customer,
            "status" => $this->status,
            "diary" => DiaryResource::make($this->whenLoaded('diary')),
            "wps" => WPResource::collection($this->whenLoaded('wps')),
            "created_at" => $this->created_at,
            "updated_at" => $this->updated_at
        ];
    }
}
