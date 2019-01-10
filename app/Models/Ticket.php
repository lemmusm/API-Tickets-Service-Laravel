<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Usuario;

class Ticket extends Model
{
    // Nombre de la tabla en MySQL.
	protected $table='tickets';

	// Eloquent asume que cada tabla tiene una clave primaria con una columna llamada id.
	// Si éste no fuera el caso entonces hay que indicar cuál es nuestra clave primaria en la tabla:
	protected $primaryKey = 'id_ticket';
	
    public function usuario()
    {
        return $this->belongsTo(Usuario::class, 'usuario_uid', 'uid');
    }
}
