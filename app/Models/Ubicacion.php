<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Ubicacion extends Model
{
    // SoftDelete
    use SoftDeletes;
    // Nombre de la tabla en MySQL.
    protected $table = 'ubicaciones';
    // Agrega campo 'deleted_at' para marcar borrados
    protected $dates = ['deleted_at'];

    // Eloquent asume que cada tabla tiene una clave primaria con una columna llamada id.
    // Si éste no fuera el caso entonces hay que indicar cuál es nuestra clave primaria en la tabla:
    protected $primaryKey = 'id_ubicacion';

    public function departamentos() {
        return $this->hasMany(Departamento::class, 'ubicacion_id', 'id_ubicacion');
    }

}
