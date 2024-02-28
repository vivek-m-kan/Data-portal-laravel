<?php

namespace App\Utils;

use Illuminate\Database\Eloquent\Collection;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;

class ApiResponse
{
    public static function success(string $message, Model|Collection|array $data = null)
    {
        $response = [
            "message" => $message,
            "data" => $data
        ];
        return response()->json($response, Response::HTTP_OK);
    }
}
