<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Interesado extends Model
{
    use HasFactory;

    protected $fillable = [
        'carrera_id', 
        'nombre_completo', 
        'telefono', 
        'correo'
    ];

    public function carrera()
    {
        return $this->belongsTo(Carrera::class);
    }
}