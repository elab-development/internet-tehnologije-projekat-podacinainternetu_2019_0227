<?php

namespace App\Http\Resources;

use App\Models\Zaposleni;
use Illuminate\Http\Resources\Json\JsonResource;

class TaskResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'naziv' => $this->naziv,
            'opis' => $this->opis,
            'rok' => $this->rok,
            'status' => $this->status,
            'zaposleni' => new ZaposleniResource(Zaposleni::find($this->zaposleni_id)),
        ];
    }
}
