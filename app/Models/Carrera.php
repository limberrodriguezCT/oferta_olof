<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Carrera extends Model
{
    use HasFactory;

    protected $fillable = [
        'nombre',
        'nivel_formacion',
        'perfil_profesional',
        'cargos_ocupaciones',
        'duracion_diurno',
        'duracion_sabatino',
        'ambito_profesional',
        'requisitos',
        'imagen_ruta',
        'video_url',
        'anio_academico'
    ];

    public function interesados()
    {
        return $this->hasMany(Interesado::class);
    }

    // Atributo dinámico que extrae el ID del video y lo convierte a formato embed
    public function getEmbedVideoAttribute()
    {
        if (!$this->video_url) {
            return null;
        }

        preg_match('/(?:youtube\.com\/(?:[^\/]+\/.+\/|(?:v|e(?:mbed)?)\/|.*[?&]v=)|youtu\.be\/)([^"&?\/\s]{11})/i', $this->video_url, $matches);

        if (isset($matches[1])) {
            return 'https://www.youtube.com/embed/' . $matches[1];
        }

        return null;
    }
}