<?php

namespace App\Http\Controllers;

use App\Models\Servicio;
use Illuminate\Http\Request;

class ServicioController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Servicio::select(
            'id_servicio',
            'servicio'
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
        $servicio = new Servicio();

        if (!is_null($servicio)) {
            $servicio->servicio = $request->servicio;
            $servicio->save();

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
     * @param  \App\servicios  $servicios
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $servicio = Servicio::select(
            'id_servicio',
            'servicio')
            ->find($id);

        if ($servicio) {
            return $servicio;
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
     * @param  \App\servicios  $servicios
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $servicio = new Servicio();

        $servicio = Servicio::where('id_servicio', $id)->update(
            [
                'servicio' => $request->get('servicio'),
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
     * @param  \App\servicios  $servicios
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if ($id != null) {
            $servicio = Servicio::find($id);
            $servicio->delete();

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
