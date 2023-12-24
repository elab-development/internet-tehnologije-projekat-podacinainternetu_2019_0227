<?php

namespace App\Http\Resources;

use App\Models\Firma;
use Illuminate\Http\Resources\Json\JsonResource;

class FajlResource extends JsonResource
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
            'putanja' => $this->putanja,
            'firma' => Firma::find($this->firma_id),
        ];
    }
}
