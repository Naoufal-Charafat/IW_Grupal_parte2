<?php

namespace App\Traits;

use Illuminate\Http\JsonResponse;

trait ApiResponses
{
    /**
     * Retorna una respuesta de éxito estandarizada.
     * Permite personalizar la clave de los datos (ej: 'services' en lugar de 'data').
     *
     * @param  mixed  $data
     * @param  string|null  $message
     * @param  int  $statusCode
     * @param  string  $key  Nombre de la clave para los datos (default: 'data')
     * @return JsonResponse
     */
    protected function success(mixed $data, ?string $message = null, int $statusCode = 200, string $key = 'data'): JsonResponse
    {
        $response = [
            'status' => 'success',
        ];

        // Solo añadimos el mensaje si no es nulo, para limpiar la respuesta
        if (! is_null($message)) {
            $response['message'] = $message;
        }

        $response[$key] = $data;

        return response()->json($response, $statusCode);
    }

    /**
     * Retorna una respuesta de error estandarizada.
     *
     * @param  string  $message
     * @param  int  $statusCode
     * @param  mixed  $errors
     * @return JsonResponse
     */
    protected function error(string $message, int $statusCode = 400, mixed $errors = null): JsonResponse
    {
        $response = [
            'status' => 'error',
            'message' => $message,
        ];

        if (! is_null($errors)) {
            $response['errors'] = $errors;
        }

        return response()->json($response, $statusCode);
    }

    /**
     * Helper para error 401 Unauthorized (Token faltante o inválido).
     */
    protected function unauthorized(string $message = 'No autorizado'): JsonResponse
    {
        return $this->error($message, 401);
    }

    /**
     * Helper para error 403 Forbidden.
     */
    protected function forbidden(string $message = 'Acceso denegado'): JsonResponse
    {
        return $this->error($message, 403);
    }

    /**
     * Helper para error 404 Not Found.
     */
    protected function notFound(string $message = 'Recurso no encontrado'): JsonResponse
    {
        return $this->error($message, 404);
    }

    /**
     * Helper para error 422 Unprocessable Entity (Datos inválidos).
     */
    protected function validationError(mixed $errors, string $message = 'Datos inválidos'): JsonResponse
    {
        return $this->error($message, 422, $errors);
    }
}