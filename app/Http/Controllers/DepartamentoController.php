<?php

namespace App\Http\Controllers;

use App\Models\Departamento;
use Illuminate\Http\Request;

class DepartamentoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Departamento::with('usuarios')
            ->orderBy('departamento', 'desc')
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
        $departamento = new Departamento();

        $validateData = $request->validate([
            'departamento' => 'required|unique:departamentos',
        ]);

        if (!is_null($departamento)) {

            $departamento->departamento = $request->departamento;
            $departamento->ubicacion = $request->ubicacion;
            $departamento->save();

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
     * @param  \App\Models\Departamento  $departamento
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $departamento = Departamento::with('usuarios')->find($id);

        if ($departamento) {
            return $departamento;
        } else {
            $response = array(
                'status' => 'error',
                'code' => 400,
                'message' => 'Error: No se encontro el registro',
            );
        }
        return $response;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Departamento  $departamento
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $departamento = new Departamento();

        $departamento = Departamento::where('id_departamento', $id)->update(
            [
                'departamento' => $request->get('departamento'),
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
     * @param  \App\Models\Departamento  $departamento
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if ($id != null) {
            $dpto = Departamento::find($id);
            $dpto->delete();

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
