<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Servicio extends Model
{
    // SoftDelete
    use SoftDeletes;
    // Nombre de la tabla en MySQL.
    protected $table = 'servicios';
    // Agrega campo 'deleted_at' para marcar borrados
    protected $dates = ['deleted_at'];

    // Eloquent asume que cada tabla tiene una clave primaria con una columna llamada id.
    // Si éste no fuera el caso entonces hay que indicar cuál es nuestra clave primaria en la tabla:
    protected $primaryKey = 'id_servicio';

    public function tickets()
    {
        return $this->hasMany(Ticket::class, 'servicio_id', 'id_servicio');
    }
}
