<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Firma extends Model
{
    use HasFactory;
    protected $fillable = [
        'naziv',
        'PIB',
        'maticniBroj',
        'adresa',  
        'kontaktTelefon',
        'email',  
       
    ];

    public function zaposleni()
    {
            return $this->hasMany(Zaposleni::class);
    }

}
