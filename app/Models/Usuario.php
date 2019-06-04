<?php

namespace App\Models;

use App\Models\Departamento;
use App\Models\Ticket;
use App\Models\Roles;
use Illuminate\Database\Eloquent\Model;

class Usuario extends Model
{
    // Nombre de la tabla en MySQL.
    protected $table = 'usuarios';

    // Eloquent asume que cada tabla tiene una clave primaria con una columna llamada id.
    // Si éste no fuera el caso entonces hay que indicar cuál es nuestra clave primaria en la tabla:
    protected $primaryKey = 'uid';
    // Deshabilita el autoincremento
    public $incrementing = false;

    // Relaciones
    public function tickets()
    {
        return $this->hasMany(Ticket::class, 'usuario_uid', 'uid');
    }

    public function departamento()
    {
        return $this->belongsTo(Departamento::class, 'departamento_id', 'id_departamento');
    }

    public function rol()
    {
        return $this->belongsTo(Roles::class, 'rol_id', 'id_rol');
    }
}
