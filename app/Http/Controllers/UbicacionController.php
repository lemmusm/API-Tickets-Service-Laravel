<?php

namespace App\Http\Controllers;

use App\Models\Ubicacion;
use Illuminate\Http\Request;

class UbicacionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Ubicacion::select(
            'id_ubicacion',
            'ubicacion'
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
        $ubicacion = new Ubicacion();

        if (!is_null($ubicacion)) {
            $ubicacion->ubicacion = $request->ubicacion;
            $ubicacion->save();

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
     * @param  \App\ubicaciones  $ubicaciones
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $ubicacion = Ubicacion::select(
            'id_ubicacion',
            'ubicacion')
            ->find($id);

        if ($ubicacion) {
            return $ubicacion;
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
     * @param  \App\ubicaciones  $ubicaciones
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $ubicacion = new Ubicacion();

        $ubicacion = Ubicacion::where('id_ubicacion', $id)->update(
            [
                'ubicacion' => $request->get('ubicacion'),
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
     * @param  \App\ubicaciones  $ubicaciones
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if ($id != null) {
            $ubicacion = Ubicacion::find($id);
            $ubicacion->delete();

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
