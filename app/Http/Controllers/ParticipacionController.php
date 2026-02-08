<?php

namespace App\Http\Controllers;

use App\Models\Participacion;
use App\Models\Evento;
use App\Services\WebSocketService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ParticipacionController extends Controller
{
    /**
     * Listar todas las participaciones
     */
    public function index()
    {
        $participaciones = Participacion::with(['usuario', 'evento'])->get();
        return response()->json($participaciones);
    }

    /**
     * Registrar una nueva participación
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'IDUsuario' => 'required|exists:users,id',
            'IDEvento' => 'required|exists:eventos,IDEvento',
            'PuntajeEvento' => 'nullable|integer',
            'TiempoLogrado' => 'nullable|integer'
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 400);
        }

        $participacion = Participacion::create($request->all());

        // Notificar nueva participación en el evento
        WebSocketService::broadcast('nueva-participacion', [
            'participacion_id' => $participacion->IDParticipacion,
            'usuario' => $participacion->usuario->name,
            'evento_id' => $participacion->IDEvento
        ], null, "evento-{$participacion->IDEvento}");

        return response()->json([
            'message' => 'Participación registrada exitosamente',
            'participacion' => $participacion
        ], 201);
    }

    /**
     * Registrar ganador de un evento
     */
    public function registrarGanador(Request $request, $id)
    {
        $participacion = Participacion::find($id);

        if (!$participacion) {
            return response()->json(['error' => 'Participación no encontrada'], 404);
        }

        $participacion->EsGanador = true;
        $participacion->save();

        $usuario = $participacion->usuario;
        $evento = $participacion->evento;

        // Notificar al ganador específicamente
        WebSocketService::notificarUsuario(
            $participacion->IDUsuario,
            "¡Felicidades! Has ganado el evento: {$evento->Nombre}",
            [
                'evento_id' => $evento->IDEvento,
                'evento_nombre' => $evento->Nombre,
                'es_ganador' => true
            ]
        );

        // Notificar a todos en la sala del evento
        WebSocketService::notificarGanador(
            $evento->IDEvento,
            $usuario->id,
            $usuario->name,
            [
                'puntaje' => $participacion->PuntajeEvento,
                'tiempo' => $participacion->TiempoLogrado
            ]
        );

        return response()->json([
            'message' => 'Ganador registrado correctamente',
            'participacion' => $participacion
        ]);
    }

    /**
     * Obtener participaciones de un evento
     */
    public function porEvento($eventoId)
    {
        $participaciones = Participacion::where('IDEvento', $eventoId)
            ->with('usuario')
            ->orderBy('PuntajeEvento', 'desc')
            ->get();

        return response()->json($participaciones);
    }

    /**
     * Obtener participaciones de un usuario
     */
    public function porUsuario($usuarioId)
    {
        $participaciones = Participacion::where('IDUsuario', $usuarioId)
            ->with('evento')
            ->get();

        return response()->json($participaciones);
    }
}
