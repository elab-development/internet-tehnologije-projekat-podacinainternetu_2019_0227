<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Privilegija extends Model
{
    use HasFactory;
    protected $fillable = [
        'zaposleni_id',
        'fajl_id',
        'permission', 
       
    ];

    public function zaposleni()
    {
            return $this->belongsTo(Zaposleni::class);
    }    
    public function fajl()
    {
            return $this->belongsTo(Fajl::class);
    }

}
