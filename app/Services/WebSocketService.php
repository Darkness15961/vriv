<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class WebSocketService
{
    /**
     * URL del servidor WebSocket
     */
    private static $serverUrl = 'http://localhost:3000/broadcast';

    /**
     * Enviar evento a través de WebSocket
     *
     * @param string $event Nombre del evento
     * @param array $data Datos a enviar
     * @param int|null $userId ID del usuario específico (opcional)
     * @param string|null $room Sala específica (opcional, ej: "evento-1")
     * @return bool
     */
    public static function broadcast(string $event, array $data, ?int $userId = null, ?string $room = null): bool
    {
        try {
            $payload = [
                'event' => $event,
                'data' => $data
            ];

            if ($userId) {
                $payload['userId'] = $userId;
            }

            if ($room) {
                $payload['room'] = $room;
            }

            $response = Http::timeout(3)->post(self::$serverUrl, $payload);

            if ($response->successful()) {
                Log::info("WebSocket: Evento '{$event}' enviado correctamente", $payload);
                return true;
            } else {
                Log::warning("WebSocket: Error al enviar evento '{$event}'", [
                    'status' => $response->status(),
                    'response' => $response->body()
                ]);
                return false;
            }
        } catch (\Exception $e) {
            Log::error("WebSocket: Excepción al enviar evento '{$event}': " . $e->getMessage());
            return false;
        }
    }

    /**
     * Enviar notificación a un usuario específico
     *
     * @param int $userId
     * @param string $mensaje
     * @param array $data Datos adicionales
     * @return bool
     */
    public static function notificarUsuario(int $userId, string $mensaje, array $data = []): bool
    {
        return self::broadcast('nueva-notificacion', array_merge([
            'mensaje' => $mensaje
        ], $data), $userId);
    }

    /**
     * Notificar actualización de evento a todos los participantes
     *
     * @param int $eventoId
     * @param string $estado
     * @param array $data
     * @return bool
     */
    public static function notificarEvento(int $eventoId, string $estado, array $data = []): bool
    {
        return self::broadcast('evento-actualizado', array_merge([
            'evento_id' => $eventoId,
            'estado' => $estado
        ], $data), null, "evento-{$eventoId}");
    }

    /**
     * Notificar nuevo ganador en un evento
     *
     * @param int $eventoId
     * @param int $usuarioId
     * @param string $nombreUsuario
     * @param array $data
     * @return bool
     */
    public static function notificarGanador(int $eventoId, int $usuarioId, string $nombreUsuario, array $data = []): bool
    {
        return self::broadcast('nuevo-ganador', array_merge([
            'evento_id' => $eventoId,
            'usuario_id' => $usuarioId,
            'nombre_usuario' => $nombreUsuario
        ], $data), null, "evento-{$eventoId}");
    }
}
