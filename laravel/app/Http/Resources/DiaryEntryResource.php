<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class DiaryEntryResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            "id" => $this->id,
            "text" => $this->text,
            "created_at" => $this->created_at,
            "updated_at" => $this->updated_at
        ];
    }
}
