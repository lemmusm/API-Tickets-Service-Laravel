<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Roles extends Model
{
    // Nombre de la tabla en MySQL.
    protected $table = 'roles';

    // Eloquent asume que cada tabla tiene una clave primaria con una columna llamada id.
    // Si éste no fuera el caso entonces hay que indicar cuál es nuestra clave primaria en la tabla:
    protected $primaryKey = 'id_rol';

    // public function usuario()
    // {
    //     return $this->belongsTo(Usuario::class, 'usuario_uid', 'uid');
    // }
}
