<?php

namespace App\Http\Controllers;

use App\Models\Usuario;
use Illuminate\Http\Request;

class UsuarioController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Usuario::select(
            'uid',
            'displayName',
            'email',
            'departamento_id'
        )
            ->with([
                'departamento' => function ($query) {
                    $query->select(['id_departamento', 'departamento']);
                },
            ])
            ->get();
        // ->with([
        //     'departamento' => function ($query) {
        //         $query->select(['id_departamento', 'departamento']);
        //     },
        //     'tickets' => function ($query) {
        //         $query->select(['id_ticket',
        //         'usuario_uid',
        //         'servicio_id',
        //         'descripcion',
        //         'status',
        //         'created_at']);
        //     },
        //     'tickets.servicio' => function ($query) {
        //         $query->select(['id_servicio', 'servicio']);
        //     }])
        // ->get();
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $usuario = new Usuario();

        $validateData = $request->validate([
            'uid' => 'required|unique:usuarios',
        ]);

        if (!is_null($usuario)) {
            $usuario->uid = $request->uid;
            $usuario->departamento_id = $request->departamento_id;
            $usuario->displayName = $request->displayName;
            $usuario->email = $request->email;
            $usuario->photoURL = $request->photoURL;
            $usuario->rol_id = $request->rol_id;
            $usuario->save();

            $response = array(
                'status' => 'success',
                'code' => 200,
                'message' => '::saved_user::💾',
            );
        } else {
            $response = array(
                'status' => 'error',
                'code' => 400,
                'message' => '::error_saving_user::💥',
            );
        }
        return $response;
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Usuario  $usuario
     * @return \Illuminate\Http\Response
     */
    // Usuario filtrado
    public function show($id)
    {
        $usuario = Usuario::select(
            'uid',
            'displayName',
            'email',
            'photoURL',
            'departamento_id',
            'rol_id')
            ->with([
                'departamento' => function ($query) {
                    $query->select(['id_departamento', 'departamento']);
                },
                'rol' => function ($query) {
                    $query->select(['id_rol', 'rol']);
                },
            ])
            ->find($id);

        if ($usuario) {
            return $usuario;
        } else {
            $response = array(
                'status' => 'error',
                'code' => 400,
                'message' => 'Usuario no encontrado.',
            );
            return $response;
        }
    }
    // Usuario completo

    // Filtrado de user data por id
    public function getCompleteUser($id)
    {
        $usuario = Usuario::select(
            'uid',
            'displayName',
            'email',
            'photoURL',
            'departamento_id',
            'rol_id')
            ->with([
                'departamento' => function ($query) {
                    $query->select([
                        'id_departamento',
                        'departamento']);
                },
                'rol' => function ($query) {
                    $query->select(['id_rol', 'rol']);
                },
                'tickets' => function ($query) {
                    $query->select([
                        'id_ticket',
                        'usuario_uid',
                        'servicio_id',
                        'descripcion',
                        'status',
                        'created_at']);
                },
                'tickets.servicio' => function ($query) {
                    $query->select(['id_servicio', 'servicio']);
                }])
            ->find($id);

        if ($usuario) {
            return $usuario;
        } else {
            $response = array(
                'status' => 'error',
                'code' => 400,
                'message' => 'Usuario no encontrado.',
            );
        }
        return $response;
    }
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Usuario  $usuario
     * @return \Illuminate\Http\Response
     */
/*
Actualiza los campos mencionados de la tabla usuarios,
si el campo departamento tiene valor actualiza solo nombre y photourl,
de lo contrario actualiza toso el usuario
 */
    public function update(Request $request, $id)
    {
        $usuario = new Usuario();
        $usuario = Usuario::where('uid', $id);
        $usuario->update(
            [
                'displayName' => $request->get('displayName'),
                'email' => $request->get('email'),
                'photoURL' => $request->get('photoURL'),
                'departamento_id' => $request->get('departamento_id'),
                'rol_id' => $request->get('rol_id'),
            ]
        );
        $response = array(
            'status' => 'success',
            'code' => 200,
            'message' => 'Usuario actualizado correctamente',
        );
        return $response;
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Usuario  $usuario
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if ($id != null) {
            $usuario = Usuario::find($id);
            $usuario->delete();

            $response = array(
                'status' => 'success',
                'code' => 200,
                'message' => 'Usuario eliminado correctamente.',
            );
        } else {
            $response = array(
                'status' => 'error',
                'code' => 400,
                'message' => 'Error al eliminar usuario.',
            );
        }
        return $response;
    }
}
