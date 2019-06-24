<?php

namespace App\Models;

use App\Models\Usuario;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Roles extends Model
{
    // SoftDelete
    use SoftDeletes;
    // Nombre de la tabla en MySQL.
    protected $table = 'roles';
    // Agrega campo 'deleted_at' para marcar borrados
    protected $dates = ['deleted_at'];

    // Eloquent asume que cada tabla tiene una clave primaria con una columna llamada id.
    // Si éste no fuera el caso entonces hay que indicar cuál es nuestra clave primaria en la tabla:
    protected $primaryKey = 'id_rol';

    public function usuarios()
    {
        return $this->hasMany(Usuario::class, 'rol_id', 'id_rol');
    }
}
