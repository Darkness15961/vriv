<?php

namespace App\Http\Controllers;

use App\Models\Notificacion;
use App\Services\WebSocketService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class NotificacionController extends Controller
{
    /**
     * Listar notificaciones de un usuario
     */
    public function index($usuarioId)
    {
        $notificaciones = Notificacion::where('IDUsuario', $usuarioId)
            ->orderBy('FechaCreacion', 'desc')
            ->get();

        return response()->json($notificaciones);
    }

    /**
     * Crear una nueva notificación
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'IDUsuario' => 'required|exists:users,id',
            'IDTipoNotificacion' => 'required|exists:tiponotificaciones,IDTipoNotificacion',
            'Mensaje' => 'required|string'
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 400);
        }

        $notificacion = Notificacion::create(array_merge($request->all(), [
            'FechaCreacion' => now(),
            'Leido' => false
        ]));

        // Enviar notificación en tiempo real al usuario
        WebSocketService::notificarUsuario(
            $notificacion->IDUsuario,
            $notificacion->Mensaje,
            [
                'notificacion_id' => $notificacion->IDNotificacion,
                'tipo' => $notificacion->IDTipoNotificacion,
                'fecha' => $notificacion->FechaCreacion
            ]
        );

        return response()->json([
            'message' => 'Notificación creada y enviada',
            'notificacion' => $notificacion
        ], 201);
    }

    /**
     * Marcar notificación como leída
     */
    public function marcarLeida($id)
    {
        $notificacion = Notificacion::find($id);

        if (!$notificacion) {
            return response()->json(['error' => 'Notificación no encontrada'], 404);
        }

        $notificacion->Leido = true;
        $notificacion->save();

        return response()->json([
            'message' => 'Notificación marcada como leída',
            'notificacion' => $notificacion
        ]);
    }

    /**
     * Obtener notificaciones no leídas
     */
    public function noLeidas($usuarioId)
    {
        $notificaciones = Notificacion::where('IDUsuario', $usuarioId)
            ->where('Leido', false)
            ->orderBy('FechaCreacion', 'desc')
            ->get();

        return response()->json([
            'total' => $notificaciones->count(),
            'notificaciones' => $notificaciones
        ]);
    }
}
