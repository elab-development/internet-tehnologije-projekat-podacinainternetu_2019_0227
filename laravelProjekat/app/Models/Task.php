<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    use HasFactory;
    protected $fillable = [
        'zaposleni_id',
        'naziv',
        'opis', 
        'rok', 
        'status',  //zavrseno, otkazano, u izradi
    ];
    public function zaposleni()
    {
        return $this->belongsTo(Zaposleni::class);
    }
}
