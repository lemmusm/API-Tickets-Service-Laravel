<?php

namespace App\Http\Controllers;

use App\Models\Ticket;
use Illuminate\Http\Request;

class TicketController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Ticket::with('usuario')
        // ->join('usuarios', 'usuario_uid', '=', 'usuarios.uid' )
        // ->join('departamentos', 'departamento_id', '=', 'departamentos.id_departamento' )
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
        $ticket = new Ticket();

        if (!is_null($ticket)) {

            $ticket -> usuario_uid = $request -> usuario_uid;
            $ticket -> servicio = $request -> servicio;
            $ticket -> descripcion = $request -> descripcion;
            $ticket -> diagnostico = $request -> diagnostico;
            $ticket -> tecnico = $request -> tecnico;
            $ticket -> status = $request -> status;
            $ticket -> save();

            $response = array(
                'status' => 'success',
                'code' => 200,
                'message' => 'Ticket creado correctamente.'
            );
        } else {
            $response = array(
                'status' => 'error',
                'code' => 400,
                'message' => 'Error al crear ticket.'
            );
        }
        return $response;
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Ticket  $ticket
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
       $ticket = Ticket::with('usuario')->find($id);

       if ($ticket) {
           return $ticket;
       } else {
           $response = array(
               'status' => 'error',
               'code' => 400,
               'message' => 'Registro no encontrado.'
           );
       }

       return $response;
       
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Ticket  $ticket
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $ticket = new Ticket();

        $ticket = Ticket::where('id_ticket', $id)->update(
            [
                'servicio' => $request -> get('servicio'),
                'descripcion' => $request -> get('descripcion'),
                'diagnostico' => $request -> get('diagnostico'),
                'tecnico' => $request -> get('tecnico'),
                'status' => $request -> get('status')
            ]
        );

        $response = array(
            'status' => 'success',
            'code' => 200,
            'message' => 'Ticket actualizado correctamente.'
        );

        return $response;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Ticket  $ticket
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
       if ($id != null) {
           $ticket = Ticket::find($id);
           $ticket->delete();

           $response = array(
               'status' => 'success',
               'code' => 200,
                'message' => 'Ticket eliminado correctamente.'
           );
       } else {
           $response = array(
               'status' => 'error',
               'code' => 400,
                'message' => 'Error al eliminar ticket.'
           );
       }
       return $response;
    }
}
