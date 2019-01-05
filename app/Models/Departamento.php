<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Usuario;

class Departamento extends Model
{
    // Nombre de la tabla en MySQL.
	protected $table='departamentos';

	// Eloquent asume que cada tabla tiene una clave primaria con una columna llamada id.
	// Si éste no fuera el caso entonces hay que indicar cuál es nuestra clave primaria en la tabla:
	protected $primaryKey = 'id_departamento';

	public function usuarios()
	{
		return $this->hasMany(Usuario::class, 'departamento_id', 'id_departamento' );
	}
}
