<?php

namespace App\Http;


use Illuminate\Http\JsonResponse;

trait Response
{
    /**
     * @param bool $isSuccess
     * @param string $message
     * @param array $payload
     * @return JsonResponse
     */
    public function success(bool $isSuccess, string $message = "", array $payload = []) : JsonResponse {
        return response()->json([
            'status'    => true,
            'success' => $isSuccess,
            'payload' => $payload,
            'message' => $message
        ]);
    }

    /**
     * @param string $message
     * @param array $payload
     * @return JsonResponse
     */
    public function failedWith404(string $message = "", array $payload = []) : JsonResponse {
        return response()->json([
            'status'    => true,
            'success' => false,
            'payload' => $payload,
            'message' => $message
        ], 404);
    }
}