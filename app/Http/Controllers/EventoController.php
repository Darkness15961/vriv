<?php

namespace App\Http\Controllers;

use App\Models\Evento;
use App\Services\WebSocketService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class EventoController extends Controller
{
    /**
     * Listar todos los eventos
     */
    public function index()
    {
        $eventos = Evento::with(['creador', 'tipoEvento'])->get();
        return response()->json($eventos);
    }

    /**
     * Crear un nuevo evento
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'Nombre' => 'required|string|max:150',
            'Descripcion' => 'nullable|string|max:255',
            'IDCreador' => 'required|exists:users,id',
            'IDTipoEvento' => 'required|exists:tipoeventos,IDTipo',
            'FechaInicio' => 'required|date',
            'FechaFin' => 'required|date|after:FechaInicio',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 400);
        }

        $evento = Evento::create($request->all());

        // Notificar creación de evento a todos
        WebSocketService::broadcast('evento-creado', [
            'evento_id' => $evento->IDEvento,
            'nombre' => $evento->Nombre,
            'fecha_inicio' => $evento->FechaInicio
        ]);

        return response()->json([
            'message' => 'Evento creado exitosamente',
            'evento' => $evento
        ], 201);
    }

    /**
     * Obtener un evento específico
     */
    public function show($id)
    {
        $evento = Evento::with(['creador', 'tipoEvento', 'participaciones'])->find($id);

        if (!$evento) {
            return response()->json(['error' => 'Evento no encontrado'], 404);
        }

        return response()->json($evento);
    }

    /**
     * Actualizar estado de un evento
     */
    public function actualizarEstado(Request $request, $id)
    {
        $evento = Evento::find($id);

        if (!$evento) {
            return response()->json(['error' => 'Evento no encontrado'], 404);
        }

        $validator = Validator::make($request->all(), [
            'Estado' => 'required|string|max:50'
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 400);
        }

        $evento->Estado = $request->Estado;
        $evento->save();

        // Notificar a todos los usuarios en la sala del evento
        WebSocketService::notificarEvento($evento->IDEvento, $evento->Estado, [
            'nombre' => $evento->Nombre,
            'mensaje' => "El evento '{$evento->Nombre}' cambió a estado: {$evento->Estado}"
        ]);

        return response()->json([
            'message' => 'Estado actualizado correctamente',
            'evento' => $evento
        ]);
    }

    /**
     * Finalizar un evento
     */
    public function finalizar($id)
    {
        $evento = Evento::find($id);

        if (!$evento) {
            return response()->json(['error' => 'Evento no encontrado'], 404);
        }

        $evento->Estado = 'finalizado';
        $evento->save();

        // Notificar finalización a todos en la sala
        WebSocketService::broadcast('evento-finalizado', [
            'evento_id' => $evento->IDEvento,
            'nombre' => $evento->Nombre,
            'mensaje' => "El evento '{$evento->Nombre}' ha finalizado"
        ], null, "evento-{$evento->IDEvento}");

        return response()->json([
            'message' => 'Evento finalizado correctamente',
            'evento' => $evento
        ]);
    }

    /**
     * Eliminar un evento
     */
    public function destroy($id)
    {
        $evento = Evento::find($id);

        if (!$evento) {
            return response()->json(['error' => 'Evento no encontrado'], 404);
        }

        $evento->delete();

        return response()->json(['message' => 'Evento eliminado correctamente']);
    }
}
