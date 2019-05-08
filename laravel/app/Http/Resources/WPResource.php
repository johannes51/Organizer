<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class WPResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            "id" => $this->id,
            "number" => $this->number,
            "name" => $this->name,
            "start" => $this->when($this->start != NULL, $this->start),
            "duration" => $this->when($this->duration != NULL, doubleval($this->duration)),
            "progress" => $this->when($this->progress != NULL, doubleval($this->progress)),
            "objectives" => $this->when($this->objectives != NULL, json_decode($this->objectives)),
            "inputs" => $this->when($this->inputs != NULL, json_decode($this->inputs)),
            "outputs" => $this->when($this->outputs != NULL, json_decode($this->outputs)),
            "tasks" => $this->when($this->tasks != NULL, json_decode($this->tasks)),
            "results" => $this->when($this->results != NULL, json_decode($this->results))
        ];
    }
}
