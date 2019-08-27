<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class LoanResource extends JsonResource
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
            'id' => $this->id,
            'item' => $this->item,
            'withWHOM' => $this->withWHOM,
            'direction' => $this->direction,
            'created_at' => $this->created_at
        ];
    }
}
