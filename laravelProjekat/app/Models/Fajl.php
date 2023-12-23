<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Fajl extends Model
{
    use HasFactory;
    protected $fillable = [
        'naziv',
        'opis',
        'putanja', 
       
    ];

    public function firma()
    {
        return $this->belongsTo(Firma::class);
    }

       

}
