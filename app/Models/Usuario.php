<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Ticket;
use App\Models\Departamento;

class Usuario extends Model
{
    // Nombre de la tabla en MySQL.
	protected $table='usuarios';

	// Eloquent asume que cada tabla tiene una clave primaria con una columna llamada id.
	// Si éste no fuera el caso entonces hay que indicar cuál es nuestra clave primaria en la tabla:
    protected $primaryKey = 'uid';
    // Deshabilita el autoincremento
    public $incrementing = false;

    public function tickets()
	{
		return $this->hasMany(Ticket::class, 'usuario_uid', 'uid' );
    }
    
    public function departamento()
    {
        return $this->belongsTo(Departamento::class, 'departamento_id', 'id_departamento');
    }
}
