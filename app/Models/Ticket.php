<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Ticket extends Model
{
    // SoftDelete
    use SoftDeletes;
    // Nombre de la tabla en MySQL.
	protected $table='tickets';
    // Agrega campo 'deleted_at' para marcar borrados
    protected $dates = ['deleted_at'];

	// Eloquent asume que cada tabla tiene una clave primaria con una columna llamada id.
	// Si éste no fuera el caso entonces hay que indicar cuál es nuestra clave primaria en la tabla:
	protected $primaryKey = 'id_ticket';

    public function usuario()
    {
        return $this->belongsTo(Usuario::class, 'usuario_uid', 'uid');
    }

    public function servicio() {
        return $this->belongsTo(Servicio::class, 'servicio_id', 'id_servicio');
    }
}
