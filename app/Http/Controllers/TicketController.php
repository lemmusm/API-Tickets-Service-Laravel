<?php

namespace App\Http\Controllers;

use App\Models\Ticket;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class TicketController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Ticket::join('usuarios', 'usuario_uid', '=', 'usuarios.uid')
            ->join('departamentos', 'departamento_id', '=', 'departamentos.id_departamento')
            ->join('servicios', 'servicio_id', '=', 'servicios.id_servicio')
            ->select(
                'id_ticket',
                'servicio',
                'status',
                'tecnico',
                'tickets.created_at as created_at',
                'displayName',
                'departamento')
        // ->paginate(5)
        // ->orderBy('id_ticket', 'asc')
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
            $ticket->servicio_id = $request->servicio_id;
            $ticket->descripcion = $request->descripcion;
            $ticket->diagnostico = 'Pendiente...';
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
        $ticket = Ticket::join('usuarios', 'usuario_uid', '=', 'usuarios.uid')
            ->join('departamentos', 'departamento_id', '=', 'departamentos.id_departamento')
            ->join('servicios', 'servicio_id', '=', 'servicios.id_servicio')
            ->select(
                'id_ticket',
                'servicio_id',
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

        // $ticket = Ticket::with('servicio')->find($id);

        // $ticket = Ticket::select(
        //     'id_ticket',
        //     'servicio_id',
        //     'descripcion',
        //     'diagnostico',
        //     'filesattach',
        //     'tecnico',
        //     'status',
        //     'created_at',
        //     'updated_at',
        //     'usuario_uid')
        // ->with([
        //     'servicio' => function ($query) {
        //         $query->select(['id_servicio', 'servicio']);
        //     },
        //     'usuario' => function ($query) {
        //             $query->select(['uid', 'displayName', 'email', 'departamento_id']);
        //         },
        //     'usuario.departamento' => function ($query) {
        //             $query->select(['id_departamento', 'departamento']);
        //         }
        //     ])
        // ->find($id);

        if ($ticket) {
            return $ticket;
        } else {
            $response = array(
                'status' => 'error',
                'code' => 400,
                'message' => 'Registro no encontrado.',
            );
            return $response;
        }

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
                'servicio_id' => $request->get('servicio_id'),
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
    public function infoTickets(Request $request)
    {
        $parametro = $request->get('parametro');
        return Ticket::join('usuarios', 'usuario_uid', '=', 'usuarios.uid')
            ->join('departamentos', 'departamento_id', '=', 'departamentos.id_departamento')
            ->join('servicios', 'servicio_id', '=', 'servicios.id_servicio')
            ->select("$parametro as parametro", DB::raw('COUNT(*) as count'))
            ->groupBy($parametro)
            ->get();
    }

    public function totaltickets()
    {
        return Ticket::count();
    }

// Get data por rango de fecha
    public function indicadores(Request $request)
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
