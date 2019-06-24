<?php

namespace App\Http\Controllers;

use App\Models\Roles;
use Illuminate\Http\Request;

class RolesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Roles::select(
            'id_rol',
            'rol'
        )
            ->get();
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $rol = new Roles();

        if (!is_null($rol)) {
            $rol->rol = $request->rol;
            $rol->save();

            $response = array(
                'status' => 'success',
                'code' => 200,
                'message' => 'Registro creado correctamente',
            );
        } else {
            $response = array(
                'status' => 'error',
                'code' => 400,
                'message' => 'Error: El registro no se creo correctamente',
            );
        }
        return $response;
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\roles  $roles
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $rol = Roles::select(
            'id_rol',
            'rol')
            ->find($id);

        if ($rol) {
            return $rol;
        } else {
            $response = array(
                'status' => 'error',
                'code' => 400,
                'message' => 'Error: No se encontro el registro',
            );
            return $response;
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\roles  $roles
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $rol = new Roles();

        $rol = Roles::where('id_rol', $id)->update(
            [
                'rol' => $request->get('rol'),
            ]
        );

        $response = array(
            'status' => 'success',
            'code' => 200,
            'message' => 'Registro actualizado correctamente',
        );

        return $response;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\roles  $roles
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if ($id != null) {
            $rol = Roles::find($id);
            $rol->delete();

            $response = array(
                'status' => 'success',
                'code' => 200,
                'message' => 'Registro eliminado correctamente',
            );
        } else {
            $response = array(
                'status' => 'error',
                'code' => 400,
                'message' => 'API: Error al eliminar registro',
            );
        }
        return $response;
    }
}
