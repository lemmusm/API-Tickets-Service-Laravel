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
        // return Ticket::with('usuario')
        // // ->join('usuarios', 'usuario_uid', '=', 'usuarios.uid' )
        // // ->join('departamentos', 'departamento_id', '=', 'departamentos.id_departamento' )
        // ->get();

        return Ticket::join('usuarios', 'usuario_uid', '=', 'usuarios.uid')
            ->join('departamentos', 'departamento_id', '=', 'departamentos.id_departamento')
            ->select(
                'id_ticket',
                'servicio',
                'status',
                'tecnico',
                'tickets.created_at as created_at',
                'displayName',
                'departamento')
            ->orderBy('id_ticket', 'asc')
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

            $ticket->usuario_uid = $request->usuario_uid;
            $ticket->servicio = $request->servicio;
            $ticket->descripcion = $request->descripcion;
            $ticket->diagnostico = '';
            $ticket->tecnico = '';
            $ticket->status = 'Abierto';
            $ticket->save();

            $response = array(
                'status' => 'success',
                'code' => 200,
                'message' => 'Ticket creado correctamente.',
            );
        } else {
            $response = array(
                'status' => 'error',
                'code' => 400,
                'message' => 'Error al crear ticket.',
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
        // $ticket = Ticket::with('usuario')->find($id);

        $ticket = Ticket::join('usuarios', 'usuario_uid', '=', 'usuarios.uid')
            ->join('departamentos', 'departamento_id', '=', 'departamentos.id_departamento')
            ->select(
                'id_ticket',
                'servicio',
                'descripcion',
                'diagnostico',
                'tecnico',
                'status',
                'tickets.created_at as created_at',
                'tickets.updated_at as updated_at',
                'usuario_uid',
                'displayName',
                'email',
                'departamento')
            ->find($id);

        if ($ticket) {
            return $ticket;
        } else {
            $response = array(
                'status' => 'error',
                'code' => 400,
                'message' => 'Registro no encontrado.',
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
                'servicio' => $request->get('servicio'),
                'descripcion' => $request->get('descripcion'),
                'diagnostico' => $request->get('diagnostico'),
                'tecnico' => $request->get('tecnico'),
                'status' => $request->get('status'),
            ]
        );

        $response = array(
            'status' => 'success',
            'code' => 200,
            'message' => 'Ticket actualizado correctamente.',
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
                'message' => 'Ticket eliminado correctamente.',
            );
        } else {
            $response = array(
                'status' => 'error',
                'code' => 400,
                'message' => 'Error al eliminar ticket.',
            );
        }
        return $response;
    }

    public function filtertickets()
    {
        return Ticket::join('usuarios', 'usuario_uid', '=', 'usuarios.uid')
            ->join('departamentos', 'departamento_id', '=', 'departamentos.id_departamento')
            ->select(
                'id_ticket',
                'servicio',
                'status',
                'tickets.created_at as created_at',
                'displayName',
                'departamento')
            ->orderBy('id_ticket', 'desc')
            ->take(15)
            ->get();
    }
// Graphs
    public function gtickets()
    {
        return Ticket::selectRaw('status, COUNT(*) as count')
            ->groupBy('status')
            ->orderBy('count', 'desc')
            ->get();
    }

    public function gticketsareas()
    {
        return Ticket::join('usuarios', 'usuario_uid', '=', 'usuarios.uid')
            ->join('departamentos', 'departamento_id', '=', 'departamentos.id_departamento')
            ->select('departamento')
            ->selectRaw('departamento, COUNT(*) as count')
            ->groupBy('departamento')
            ->orderBy('count', 'desc')
            ->get();
    }

    public function gservicios()
    {
        return Ticket::join('usuarios', 'usuario_uid', '=', 'usuarios.uid')
            ->join('departamentos', 'departamento_id', '=', 'departamentos.id_departamento')
            ->select('servicio')
            ->selectRaw('servicio, COUNT(*) as count')
            ->groupBy('servicio')
            ->orderBy('count', 'desc')
            ->get();
    }

    public function totaltickets()
    {
        return Ticket::count();
    }

// Get data por rango de fecha
    public function statusbydates(Request $request)
    {
        $from = $request->get('dateFrom');
        $to = $request->get('dateTo');
        return Ticket::selectRaw('status, COUNT(*) as count')
            ->groupBy('status')
            ->orderBy('count', 'desc')
            ->whereBetween('created_at', [$from, $to])
            ->get();
    }
}
