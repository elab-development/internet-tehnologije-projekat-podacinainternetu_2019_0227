<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
 

class Zaposleni extends User
{
    use HasFactory;
    protected $fillable = [
        'pozicija',
        'odeljenje',
        'datum_pocetka_rada',
        'datum_kraja_ugovora',  
        'plata',
        'firma_id',  
       
    ];
    public function firma()
    {
        return $this->belongsTo(Firma::class);
    }
    public function tasks()
    {
        return $this->hasMany(Task::class);
    }

}
