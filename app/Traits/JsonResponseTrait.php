<?php
namespace App\Traits;
use Illuminate\Http\JsonResponse;

trait JsonResponseTrait
{
    public static function success(array $options = []) : JsonResponse
    {
        return response()->json([
            'status'  => true,
            'message' => $options['message'] ?? 'Success',
            'data'    => $options['data'] ?? [],
            'meta'    => $options['meta'] ?? [],
        ], $options['code'] ?? 200);
    }

    public static function error(array $options = []) : JsonResponse
    {
        return response()->json([
            'status'  => false,
            'errors'  => $options['errors'] ?? [],
            'message' => $options['message'] ?? 'Something went wrong',
        ], $options['code'] ?? 400);
    }

    public static function notFound(string $message = 'Not found') : JsonResponse
    {
        return self::error(['message' => $message, 'code' => 404]);
    }

    public static function unauthorized(string $message = 'Unauthorized') : JsonResponse
    {
        return self::error(['message' => $message, 'code' => 401]);
    }

    public static function validationError(array $errors = [], string $message = 'Validation failed') : JsonResponse
    {
        return self::error(['message' => $message, 'errors' => $errors, 'code' => 422]);
    }

    public static function badRequest(string $message = 'Bad request') : JsonResponse
    {
        return self::error(['message' => $message, 'code' => 400]);
    }

    public static function internalServerError(string $message = 'Internal server error') : JsonResponse
    {
        return self::error(['message' => $message, 'code' => 500]);
    }
}
