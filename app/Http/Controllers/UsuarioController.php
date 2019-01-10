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
        return Usuario::with('tickets')->with('departamento')->get();
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

        // $validateData = $request -> validate([
        //     ''
        // ]);

        if (!is_null($usuario)) {
            $usuario -> uid = $request -> uid;
            $usuario -> departamento_id = $request -> departamento_id;
            $usuario -> usuario = $request -> usuario;
            $usuario -> email = $request -> email;
            $usuario -> urlavatar = $request -> urlavatar;
            $usuario -> save();

            $response = array (
                'status' => 'success',
                'code' => 200,
                'message' => 'Usuario creado correctamente.'
            );

        } else {
            $response = array (
                'status' => 'error',
                'code' => 400,
                'message' => 'Error al crear usuario.'
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
    public function show($id)
    {
        $usuario = Usuario::with('tickets')->with('departamento')->find($id);

        if ($usuario) {
            return $usuario;
        } else {
            $response = array(
                'status' => 'error',
                'code' => 400,
                'message' => 'Usuario no encontrado.'
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
    public function update(Request $request, $id)
    {
        $usuario = new Usuario();

        $usuario = Usuario::where('uid', $id)->update(
            [
                'departamento_id' => $request -> get('departamento_id'),
                'usuario' => $request -> get('usuario'),
                'email' => $request -> get('email'),
                'urlavatar' => $request -> get('urlavatar')
            ]
        );

        $response = array (
            'status' => 'success',
            'code' => 200,
            'message' => 'Usuario actualizado correctamente.'
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

            $response = array (
                'status' => 'success',
                'code' => 200,
                'message' => 'Usuario eliminado correctamente.'
            );
        } else {
            $response = array (
                'status' => 'error',
                'code' => 400,
                'message' => 'Error al eliminar usuario.'
            );
        }
        return $response;
    }
}
