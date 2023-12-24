<?php

namespace App\Http\Resources;

use App\Models\Firma;
use Illuminate\Http\Resources\Json\JsonResource;

class ZaposleniResource extends JsonResource
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
            'name' => $this->name,
            'email' => $this->email,
            'pozicija' => $this->pozicija,
            'odeljenje' => $this->odeljenje,
            'datum_pocetka_rada' => $this->datum_pocetka_rada,
            'datum_kraja_ugovora' => $this->datum_kraja_ugovora,
            'plata' => $this->plata,
            'firma' => Firma::find($this->firma_id),
       ];
    }
}
