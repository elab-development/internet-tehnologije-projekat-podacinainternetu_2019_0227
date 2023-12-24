<?php

namespace App\Http\Resources;

use App\Models\Fajl;
use App\Models\Zaposleni;
use Illuminate\Http\Resources\Json\JsonResource;

class PrivilegijaResource extends JsonResource
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
            'permission' => $this->permission,
            'zaposleni' => new ZaposleniResource(Zaposleni::find( $this->zaposleni_id)),
            'fajl' => new FajlResource(Fajl::find($this->fajl_id)),
        ];
    }
}
