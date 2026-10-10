namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Carrera extends Model
{
    use HasFactory;

    protected $fillable = [
        'nombre', 'nivel_formacion', 'perfil_profesional', 'cargos_ocupaciones',
        'duracion', 'ambito_profesional', 'requisitos', 'imagen_ruta', 
        'video_url', 'anio_academico'
    ];

    public function interesados()
    {
        return $this->hasMany(Interesado::class);
    }
}